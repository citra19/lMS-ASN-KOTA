<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Asn;
use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    /**
     * Display a listing of issued certificates
     */
    public function index(Request $request)
    {
        $activityId = $request->query('activity_id');
        $search = $request->query('q');

        $query = Certificate::with(['asn', 'activity']);

        if ($activityId) {
            $query->where('activity_id', $activityId);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('certificate_number', 'like', "%{$search}%")
                    ->orWhereHas('asn', function ($sub) use ($search) {
                        $sub->where('nip', 'like', "%{$search}%")
                            ->orWhere('name', 'like', "%{$search}%");
                    });
            });
        }

        $certificates = $query->orderBy('issued_at', 'desc')->paginate(15)->withQueryString();
        $activities = Activity::orderBy('date', 'desc')->get();
        $asns = Asn::orderBy('name', 'asc')->get();

        return view('admin.certificates.index', compact('certificates', 'activities', 'asns', 'activityId', 'search'));
    }

    /**
     * Issue a new certificate
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'asn_id' => ['required', 'exists:asns,id'],
            'activity_id' => ['required', 'exists:activities,id'],
            'certificate_number' => ['required', 'string', 'max:100', 'unique:certificates,certificate_number'],
            'issued_at' => ['required', 'date'],
        ]);

        Certificate::create($validated);

        return back()->with('success', 'E-Sertifikat berhasil diterbitkan.');
    }

    /**
     * Remove the certificate
     */
    public function destroy(Certificate $certificate)
    {
        $certificate->delete();

        return back()->with('success', 'E-Sertifikat berhasil dihapus.');
    }
}
