<?php

namespace App\Http\Controllers;

use App\Models\Asn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class KeycloakController extends Controller
{
    /**
     * Get Keycloak configuration values
     */
    protected function getConfig(): array
    {
        $redirect = config('services.keycloak.redirect');

        if (! $redirect) {
            $redirect = url('/auth/keycloak/callback');
        }

        // Keycloak server client lms-kota strictly whitelists 127.0.0.1:8000
        if (str_contains($redirect, 'localhost:8000')) {
            $redirect = str_replace('localhost:8000', '127.0.0.1:8000', $redirect);
        }

        return [
            'base_url' => rtrim(config('services.keycloak.base_url', 'https://sso.pdg.web.id'), '/'),
            'realm' => config('services.keycloak.realm', 'pemko-padang-app'),
            'client_id' => config('services.keycloak.client_id', 'lms-kota'),
            'client_secret' => config('services.keycloak.client_secret', 'g3rfI0rVwD6Tqvc6kSvC1T928ucRSqJ5'),

            'redirect_uri' => $redirect,
        ];
    }

    /**
     * Redirect ASN user to Keycloak SSO Login page
     */
    public function redirect(Request $request)
    {
        // If already logged in as ASN, redirect to intended or home
        if (Auth::guard('asn')->check()) {
            return redirect()->intended(route('home'));
        }

        // If accessed via localhost, switch to 127.0.0.1 so session cookies match callback domain
        if ($request->getHost() === 'localhost') {
            $intended = $request->has('intended') ? '?intended='.urlencode($request->query('intended')) : '';
            $port = $request->getPort() ?: 8000;

            return redirect()->to("http://127.0.0.1:{$port}/auth/keycloak/redirect{$intended}");
        }

        // Store intended URL if passed or currently in session
        if ($request->has('intended')) {
            session()->put('url.intended', $request->query('intended'));
        }

        $config = $this->getConfig();
        $state = Str::random(40);
        $request->session()->put('keycloak_state', $state);

        $query = http_build_query([
            'client_id' => $config['client_id'],
            'redirect_uri' => $config['redirect_uri'],
            'response_type' => 'code',
            'scope' => 'openid profile email',
            'state' => $state,
            'prompt' => 'login',
        ]);

        $authUrl = "{$config['base_url']}/realms/{$config['realm']}/protocol/openid-connect/auth?{$query}";

        return redirect()->away($authUrl);
    }

    /**
     * Handle callback from Keycloak SSO
     */
    public function callback(Request $request)
    {
        $state = $request->query('state');
        $code = $request->query('code');
        $error = $request->query('error');
        $errorDescription = $request->query('error_description');

        if ($error) {
            return redirect()->route('home')
                ->with('error', 'Login SSO dibatalkan atau terjadi kesalahan: '.($errorDescription ?? $error));
        }

        $savedState = $request->session()->pull('keycloak_state');
        if (! $state || ! $savedState || $state !== $savedState) {
            return redirect()->route('home')
                ->with('error', 'Validasi sesi keamanan (state) SSO tidak sesuai. Silakan ulangi login.');
        }

        if (! $code) {
            return redirect()->route('home')
                ->with('error', 'Kode otorisasi dari server SSO tidak ditemukan.');
        }

        $config = $this->getConfig();
        $tokenUrl = "{$config['base_url']}/realms/{$config['realm']}/protocol/openid-connect/token";

        try {
            // Exchange code for token
            $response = Http::asForm()->timeout(15)->post($tokenUrl, [
                'grant_type' => 'authorization_code',
                'client_id' => $config['client_id'],
                'client_secret' => $config['client_secret'],
                'code' => $code,
                'redirect_uri' => $config['redirect_uri'],
            ]);

            if (! $response->successful()) {
                Log::error('Keycloak token exchange error: '.$response->body());

                return redirect()->route('home')
                    ->with('error', 'Gagal memvalidasi token SSO ke server Pemerintah Kota Padang. Kode status: '.$response->status());
            }

            $tokenData = $response->json();
            $accessToken = $tokenData['access_token'] ?? null;
            $idToken = $tokenData['id_token'] ?? null;

            // Fetch User Profile from UserInfo Endpoint
            $userInfoUrl = "{$config['base_url']}/realms/{$config['realm']}/protocol/openid-connect/userinfo";
            $userResponse = Http::withToken($accessToken)->timeout(15)->get($userInfoUrl);

            $userData = $userResponse->successful() ? $userResponse->json() : [];

            // If ID token exists, decode payload as backup/enrichment
            if ($idToken && str_contains($idToken, '.')) {
                $parts = explode('.', $idToken);
                if (isset($parts[1])) {
                    $payload = json_decode(base64_decode(strtr($parts[1], '-_', '+/')), true);
                    if (is_array($payload)) {
                        $userData = array_merge($payload, $userData);
                    }
                }
            }

            // Extract NIP & attributes
            // In Keycloak Pemko Padang: preferred_username or nip usually stores the 18-digit NIP
            $nip = $userData['nip'] ?? $userData['preferred_username'] ?? $userData['username'] ?? null;
            $name = $userData['name'] ?? trim(($userData['given_name'] ?? '').' '.($userData['family_name'] ?? ''));
            $email = $userData['email'] ?? null;
            $opd = $userData['opd'] ?? $userData['instansi'] ?? $userData['department'] ?? 'Pemerintah Kota Padang';
            $position = $userData['position'] ?? $userData['jabatan'] ?? 'Pegawai ASN';
            $rankGroup = $userData['golongan'] ?? $userData['pangkat'] ?? null;

            if (! $nip) {
                return redirect()->route('home')
                    ->with('error', 'Data profil SSO tidak memuat informasi NIP yang valid.');
            }

            // Clean NIP (digits only)
            $cleanedNip = preg_replace('/[^0-9]/', '', (string) $nip);
            if (strlen($cleanedNip) >= 18) {
                $nip = substr($cleanedNip, 0, 18);
            }

            if (empty($name)) {
                $name = 'Pegawai ASN ('.$nip.')';
            }

            // Create or update ASN record in database
            $asn = Asn::updateOrCreate(
                ['nip' => $nip],
                [
                    'name' => $name,
                    'email' => $email,
                    'opd' => $opd,
                    'position' => $position,
                    'rank_group' => $rankGroup,
                    'password' => Hash::make(Str::random(32)),
                ]
            );

            // Log in using 'asn' guard
            Auth::guard('asn')->login($asn, true);
            $request->session()->regenerate();

            return redirect()->intended(route('home'))
                ->with('success', 'Berhasil masuk melalui Single Sign-On (SSO) ASN Pemko Padang! Selamat datang, '.$asn->name.'.');

        } catch (\Throwable $e) {
            Log::error('Keycloak callback exception: '.$e->getMessage());

            return redirect()->route('home')
                ->with('error', 'Terjadi gangguan koneksi saat menghubungi server SSO Pemko Padang: '.$e->getMessage());
        }
    }

    /**
     * Handle Keycloak Logout
     */
    public function logout(Request $request)
    {
        Auth::guard('asn')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $config = $this->getConfig();
        $logoutUrl = "{$config['base_url']}/realms/{$config['realm']}/protocol/openid-connect/logout?".http_build_query([
            'client_id' => $config['client_id'],
            'post_logout_redirect_uri' => route('home'),
        ]);

        return redirect()->away($logoutUrl);
    }
}
