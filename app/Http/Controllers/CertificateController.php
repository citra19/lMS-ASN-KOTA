<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller
{
    /**
     * Display the official Certificate printable page
     */
    public function show(int $id)
    {
        $certificate = Certificate::with(['asn', 'activity'])->findOrFail($id);

        // Security check: only allow the owner ASN or logged-in admin
        if (Auth::guard('asn')->check()) {
            if ($certificate->asn_id !== Auth::guard('asn')->id()) {
                abort(403, 'Anda tidak memiliki hak akses untuk sertifikat ini.');
            }
        } elseif (! Auth::check()) {
            return redirect()->route('login');
        }

        $signer = [
            'name' => Setting::get('head_officer_name', 'TARMIZI ISMAIL, S.Sos., M.Si'),
            'nip' => Setting::get('head_officer_nip', '196803031989021003'),
            'title' => Setting::get('head_officer_title', 'Plt. Kepala BKPSDM Kota Padang'),
            'agency' => Setting::get('agency_name', 'Badan Kepegawaian dan Pengembangan Sumber Daya Manusia Kota Padang'),
        ];

        $verifyUrl = route('certificates.verify', $certificate->certificate_number);
        $qrCodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=160x160&data='.urlencode($verifyUrl);

        return view('public.certificates.show', compact('certificate', 'signer', 'verifyUrl', 'qrCodeUrl'));
    }

    /**
     * Public Verification Page (scanned via QR Code)
     */
    public function verify(string $number)
    {
        $certificate = Certificate::with(['asn', 'activity'])
            ->where('certificate_number', $number)
            ->first();

        $signer = [
            'name' => Setting::get('head_officer_name', 'TARMIZI ISMAIL, S.Sos., M.Si'),
            'nip' => Setting::get('head_officer_nip', '196803031989021003'),
            'title' => Setting::get('head_officer_title', 'Plt. Kepala BKPSDM Kota Padang'),
        ];

        return view('public.certificates.verify', compact('certificate', 'number', 'signer'));
    }
}
