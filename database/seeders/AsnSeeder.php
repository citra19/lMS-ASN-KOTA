<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Asn;
use App\Models\Attendance;
use App\Models\Certificate;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AsnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $asns = [
            [
                'nip' => '198507152010011012',
                'name' => 'Budi Setiawan, S.STP, M.Si',
                'email' => 'budi.setiawan@padang.go.id',
                'opd' => 'Dinas Komunikasi dan Informatika',
                'position' => 'Pranata Komputer Ahli Muda',
                'rank_group' => 'Penata Tk. I / III/d',
                'phone' => '081267890123',
                'password' => Hash::make('password123'),
            ],
            [
                'nip' => '199003202014022003',
                'name' => 'Siti Rahmah, S.E, M.M',
                'email' => 'siti.rahmah@padang.go.id',
                'opd' => 'Badan Kepegawaian & Pengembangan SDM',
                'position' => 'Analis SDM Aparatur Ahli Muda',
                'rank_group' => 'Penata / III/c',
                'phone' => '081374561234',
                'password' => Hash::make('password123'),
            ],
            [
                'nip' => '198811052011011005',
                'name' => 'Rahmat Hidayat, S.Kom',
                'email' => 'rahmat.h@padang.go.id',
                'opd' => 'Bappeda Kota Padang',
                'position' => 'Perencana Ahli Pertama',
                'rank_group' => 'Penata Muda Tk. I / III/b',
                'phone' => '082189012345',
                'password' => Hash::make('password123'),
            ],
            [
                'nip' => '199405122019032008',
                'name' => 'dr. Annisa Putri',
                'email' => 'annisa.putri@padang.go.id',
                'opd' => 'Dinas Kesehatan / RSUD dr. Rasidin',
                'position' => 'Dokter Ahli Pertama',
                'rank_group' => 'Penata Muda Tk. I / III/b',
                'phone' => '085266778899',
                'password' => Hash::make('password123'),
            ],
            [
                'nip' => '198204182006041009',
                'name' => 'Hendri Saputra, S.Pd, M.Pd',
                'email' => 'hendri.s@padang.go.id',
                'opd' => 'Dinas Pendidikan dan Kebudayaan',
                'position' => 'Guru Ahli Madya',
                'rank_group' => 'Pembina / IV/a',
                'phone' => '081166554433',
                'password' => Hash::make('password123'),
            ],
        ];

        foreach ($asns as $data) {
            $asn = Asn::updateOrCreate(['nip' => $data['nip']], $data);
        }

        // Add sample attendances and certificates for past activities
        $completedActivity = Activity::where('status', 'completed')->first();
        if ($completedActivity) {
            $asnBudi = Asn::where('nip', '198507152010011012')->first();
            $asnSiti = Asn::where('nip', '199003202014022003')->first();

            if ($asnBudi) {
                Attendance::updateOrCreate([
                    'asn_id' => $asnBudi->id,
                    'activity_id' => $completedActivity->id,
                    'platform' => 'zoom',
                ], [
                    'attended_at' => now()->subDays(7)->setTime(9, 12, 0),
                    'ip_address' => '103.14.22.5',
                    'user_agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X)',
                ]);

                Certificate::updateOrCreate([
                    'asn_id' => $asnBudi->id,
                    'activity_id' => $completedActivity->id,
                ], [
                    'certificate_number' => '800/CERT-RB23/'.$asnBudi->nip.'/2026',
                    'issued_at' => now()->subDays(6)->toDateString(),
                ]);
            }

            if ($asnSiti) {
                Attendance::updateOrCreate([
                    'asn_id' => $asnSiti->id,
                    'activity_id' => $completedActivity->id,
                    'platform' => 'zoom',
                ], [
                    'attended_at' => now()->subDays(7)->setTime(9, 5, 0),
                    'ip_address' => '103.14.22.8',
                    'user_agent' => 'Mozilla/5.0 (Windows NT 10.0)',
                ]);

                Certificate::updateOrCreate([
                    'asn_id' => $asnSiti->id,
                    'activity_id' => $completedActivity->id,
                ], [
                    'certificate_number' => '800/CERT-RB23/'.$asnSiti->nip.'/2026',
                    'issued_at' => now()->subDays(6)->toDateString(),
                ]);
            }
        }
    }
}
