<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asn;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    /**
     * Display a listing of registered ASN participants
     */
    public function index(Request $request)
    {
        $search = $request->query('q');
        $opd = $request->query('opd');

        $query = Asn::withCount(['attendances', 'certificates']);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nip', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhere('position', 'like', "%{$search}%");
            });
        }

        if ($opd) {
            $query->where('opd', $opd);
        }

        $participants = $query->orderBy('name', 'asc')->paginate(15)->withQueryString();
        $opdList = Asn::select('opd')->distinct()->pluck('opd');

        return view('admin.participants.index', compact('participants', 'search', 'opd', 'opdList'));
    }

    /**
     * Display the specified ASN details and history
     */
    public function show(Asn $participant)
    {
        $participant->load([
            'attendances.activity',
            'certificates.activity',
        ]);

        return view('admin.participants.show', compact('participant'));
    }
}
