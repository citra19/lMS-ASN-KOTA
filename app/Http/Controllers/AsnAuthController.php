<?php

namespace App\Http\Controllers;

use App\Models\Asn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AsnAuthController extends Controller
{
    /**
     * Show login form for ASN
     */
    public function showLogin()
    {
        return redirect()->route('keycloak.redirect');
    }

    /**
     * Handle ASN login
     */
    public function login(Request $request)
    {
        // If an administrator enters an email instead of NIP, redirect them to the Admin Login portal
        if (str_contains((string) $request->nip, '@')) {
            return redirect()->route('admin.login')
                ->with('info', 'Anda memasukkan alamat email. Untuk mengelola LMS sebagai Administrator, silakan masuk melalui halaman pengelola ini.');
        }

        $request->validate([
            'nip' => ['required', 'string', 'digits:18'],
            'password' => ['required', 'string'],
        ], [
            'nip.required' => 'NIP wajib diisi.',
            'nip.digits' => 'NIP harus berjumlah 18 digit angka.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        $asn = Asn::where('nip', $request->nip)->first();

        if (! $asn) {
            return back()->withErrors([
                'nip' => 'NIP '.$request->nip.' belum terdaftar di database lokal LMS. Jika Anda adalah ASN Pemko Padang, silakan klik tombol biru "Masuk dengan SSO ASN Pemko Padang" di atas, atau klik "Daftar / Aktivasi Data ASN Baru" di bawah.',
            ])->onlyInput('nip');
        }

        if (! Hash::check($request->password, $asn->password)) {
            return back()->withErrors([
                'password' => 'Kata sandi yang Anda masukkan salah untuk NIP '.$request->nip.'.',
            ])->onlyInput('nip');
        }

        Auth::guard('asn')->login($asn, $request->boolean('remember'));
        $request->session()->regenerate();

        return redirect()->intended(route('home'))
            ->with('success', 'Selamat datang, '.$asn->name.'! Anda berhasil masuk.');
    }

    /**
     * Show registration/activation form for ASN
     */
    public function showRegister()
    {
        return redirect()->route('keycloak.redirect');
    }

    /**
     * Register new ASN
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'nip' => ['required', 'string', 'digits:18', 'unique:asns,nip'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'opd' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'rank_group' => ['nullable', 'string', 'max:100'],
            'phone' => ['nullable', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            'nip.required' => 'NIP wajib diisi.',
            'nip.digits' => 'NIP harus 18 digit.',
            'nip.unique' => 'NIP ini telah terdaftar dalam sistem.',
            'password.min' => 'Kata sandi minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $asn = Asn::create($validated);

        Auth::guard('asn')->login($asn);
        $request->session()->regenerate();

        return redirect()->intended(route('home'))
            ->with('success', 'Aktivasi akun berhasil! Selamat datang, '.$asn->name.'.');
    }

    /**
     * Handle ASN logout
     */
    public function logout(Request $request)
    {
        Auth::guard('asn')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')
            ->with('info', 'Anda telah berhasil keluar dari sesi ASN.');
    }
}
