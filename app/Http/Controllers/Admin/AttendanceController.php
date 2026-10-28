<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AttendanceController extends Controller
{
    /**
     * Display a listing of participant attendances
     */
    public function index(Request $request)
    {
        $activityId = $request->query('activity_id');
        $search = $request->query('q');

        $query = Attendance::with(['asn', 'activity']);

        if ($activityId) {
            $query->where('activity_id', $activityId);
        }

        if ($search) {
            $query->whereHas('asn', function ($q) use ($search) {
                $q->where('nip', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhere('opd', 'like', "%{$search}%");
            });
        }

        $attendances = $query->orderBy('attended_at', 'desc')->paginate(20)->withQueryString();
        $activities = Activity::orderBy('date', 'desc')->get();

        return view('admin.attendances.index', compact('attendances', 'activities', 'activityId', 'search'));
    }

    /**
     * Export attendance data as CSV
     */
    public function export(Request $request): StreamedResponse
    {
        $activityId = $request->query('activity_id');
        $activity = $activityId ? Activity::find($activityId) : null;
        $fileName = 'Rekap_Presensi_Rabu_Belajar_'.($activity ? $activity->slug : 'Semua').'_'.date('Ymd_His').'.csv';

        $query = Attendance::with(['asn', 'activity']);
        if ($activityId) {
            $query->where('activity_id', $activityId);
        }
        $data = $query->orderBy('attended_at', 'desc')->get();

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
        ];

        return response()->stream(function () use ($data) {
            $output = fopen('php://output', 'w');
            // Add UTF-8 BOM for Excel compatibility
            fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

            fputcsv($output, ['No', 'Tanggal Hadir', 'Waktu', 'NIP', 'Nama ASN', 'Perangkat Daerah (OPD)', 'Jabatan', 'Kegiatan', 'Platform']);

            $no = 1;
            foreach ($data as $row) {
                fputcsv($output, [
                    $no++,
                    $row->attended_at->format('Y-m-d'),
                    $row->attended_at->format('H:i:s'),
                    "'".$row->asn->nip,
                    $row->asn->name,
                    $row->asn->opd,
                    $row->asn->position,
                    $row->activity->title,
                    strtoupper($row->platform),
                ]);
            }
            fclose($output);
        }, 200, $headers);
    }
}
