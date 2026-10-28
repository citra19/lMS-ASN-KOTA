<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Asn;
use App\Models\AssessmentAttempt;
use App\Models\Attendance;
use App\Models\Certificate;
use App\Models\Evaluation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoParticipantSeeder extends Seeder
{
    /**
     * Seed realistic ASN participants, attendances, assessment results, and evaluations
     */
    public function run(): void
    {
        $opds = [
            'Dinas Komunikasi dan Informatika',
            'Badan Pendapatan Daerah',
            'Dinas Pendidikan dan Kebudayaan',
            'Dinas Kesehatan',
            'Badan Kepegawaian dan Pengembangan SDM',
            'Sekretariat Daerah',
            'Dinas Kependudukan dan Pencatatan Sipil',
            'Badan Perencanaan Pembangunan Daerah',
            'Inspektorat Daerah',
            'Dinas Sosial',
        ];

        $asnData = [
            ['name' => 'Fajri Ramadhan, S.Kom', 'nip' => '199204122019031008', 'opd' => $opds[0], 'rank_group' => 'Penata Muda (III/a)', 'position' => 'Pranata Komputer Ahli Pertama'],
            ['name' => 'Rahmat Hidayat, S.STP', 'nip' => '199008152012061001', 'opd' => $opds[1], 'rank_group' => 'Penata (III/c)', 'position' => 'Analis Kebijakan Ahli Muda'],
            ['name' => 'Dewi Sartika, S.Pd., M.Pd', 'nip' => '198711032010012015', 'opd' => $opds[2], 'rank_group' => 'Penata Tingkat I (III/d)', 'position' => 'Pengembang Teknologi Pembelajaran'],
            ['name' => 'dr. Ilham Pratama', 'nip' => '199105202018021004', 'opd' => $opds[3], 'rank_group' => 'Penata Muda Tingkat I (III/b)', 'position' => 'Dokter Ahli Pertama'],
            ['name' => 'Aulia Rahmi, S.Psi', 'nip' => '199403182020122009', 'opd' => $opds[4], 'rank_group' => 'Penata Muda (III/a)', 'position' => 'Analis SDM Aparatur'],
            ['name' => 'Zulfikar, S.H', 'nip' => '198506142009021003', 'opd' => $opds[5], 'rank_group' => 'Pembina (IV/a)', 'position' => 'Perancang Peraturan Perundang-undangan'],
            ['name' => 'Yuliana Putri, A.Md', 'nip' => '199607222022032007', 'opd' => $opds[6], 'rank_group' => 'Pengatur (II/c)', 'position' => 'Pengelola Sistem Informasi Kependudukan'],
            ['name' => 'Bambang Irawan, S.E., M.Ec.Dev', 'nip' => '198810052011011006', 'opd' => $opds[7], 'rank_group' => 'Penata Tingkat I (III/d)', 'position' => 'Perencana Ahli Muda'],
            ['name' => 'Fitria Handayani, S.E., Ak', 'nip' => '198909192014032002', 'opd' => $opds[8], 'rank_group' => 'Penata (III/c)', 'position' => 'Auditor Ahli Muda'],
            ['name' => 'Muhammad Ridwan, S.Sos', 'nip' => '199301102019031005', 'opd' => $opds[9], 'rank_group' => 'Penata Muda (III/a)', 'position' => 'Penyuluh Sosial Ahli Pertama'],
            ['name' => 'Siti Khadijah, S.Kom', 'nip' => '199502142020122011', 'opd' => $opds[0], 'rank_group' => 'Penata Muda (III/a)', 'position' => 'Pranata Komputer'],
            ['name' => 'Andi Wijaya, S.E', 'nip' => '199012012015031002', 'opd' => $opds[1], 'rank_group' => 'Penata (III/c)', 'position' => 'Pemeriksa Pajak Daerah'],
            ['name' => 'Nurlina, S.Pd', 'nip' => '198804172011012008', 'opd' => $opds[2], 'rank_group' => 'Penata (III/c)', 'position' => 'Guru Ahli Muda'],
            ['name' => 'Ns. Hendra Kurniawan, S.Kep', 'nip' => '199208082019031012', 'opd' => $opds[3], 'rank_group' => 'Penata Muda Tingkat I (III/b)', 'position' => 'Perawat Ahli Pertama'],
            ['name' => 'Rina Marlina, S.IP', 'nip' => '199307302019032014', 'opd' => $opds[4], 'rank_group' => 'Penata Muda (III/a)', 'position' => 'Pranata Mutasi Kepegawaian'],
            ['name' => 'Taufik Hidayat, S.STP', 'nip' => '199109092013061003', 'opd' => $opds[5], 'rank_group' => 'Penata (III/c)', 'position' => 'Kepala Sub Bagian Protokol'],
            ['name' => 'Marlina Sari, S.Kom', 'nip' => '199411252020122018', 'opd' => $opds[6], 'rank_group' => 'Penata Muda (III/a)', 'position' => 'Operator SIAK'],
            ['name' => 'Dedi Susanto, S.Si', 'nip' => '198905062014021001', 'opd' => $opds[7], 'rank_group' => 'Penata (III/c)', 'position' => 'Statistisi Ahli Muda'],
            ['name' => 'Agus Priyanto, S.H', 'nip' => '198603152010011009', 'opd' => $opds[8], 'rank_group' => 'Penata Tingkat I (III/d)', 'position' => 'P2UPD Ahli Muda'],
            ['name' => 'Nurul Aini, S.Tr.Sos', 'nip' => '199609122022032005', 'opd' => $opds[9], 'rank_group' => 'Penata Muda (III/a)', 'position' => 'Pekerja Sosial Ahli Pertama'],
            ['name' => 'Irfan Maulana, S.Kom', 'nip' => '199306282019031007', 'opd' => $opds[0], 'rank_group' => 'Penata Muda (III/a)', 'position' => 'Sandiman Ahli Pertama'],
            ['name' => 'Rini Anggraini, S.E', 'nip' => '199101152015032004', 'opd' => $opds[1], 'rank_group' => 'Penata Muda Tingkat I (III/b)', 'position' => 'Penilai Pajak Daerah'],
            ['name' => 'Yusuf Habibi, M.Pd', 'nip' => '198708212010011005', 'opd' => $opds[2], 'rank_group' => 'Penata Tingkat I (III/d)', 'position' => 'Pamong Belajar Ahli Muda'],
            ['name' => 'drg. Maya Novita', 'nip' => '199002282016042001', 'opd' => $opds[3], 'rank_group' => 'Penata (III/c)', 'position' => 'Dokter Gigi Ahli Muda'],
            ['name' => 'Budi Santoso, S.Sos', 'nip' => '198912122014031003', 'opd' => $opds[4], 'rank_group' => 'Penata (III/c)', 'position' => 'Analis Pengembangan Karir'],
        ];

        $asns = [];
        foreach ($asnData as $data) {
            $asns[] = Asn::updateOrCreate(
                ['nip' => $data['nip']],
                array_merge($data, [
                    'email' => strtolower(str_replace([' ', ',', '.'], '', explode(' ', $data['name'])[0])).'@padang.go.id',
                    'password' => Hash::make('password123'),
                ])
            );
        }

        // Activities
        $activities = Activity::orderBy('date', 'asc')->get();

        foreach ($activities as $actIndex => $act) {
            // Determine participation count based on activity status
            $participantCount = match ($act->status) {
                'completed' => 20 + ($actIndex * 2),
                'ongoing' => 14,
                default => 0,
            };

            for ($i = 0; $i < min($participantCount, count($asns)); $i++) {
                $asn = $asns[$i];

                // 1. Attendance
                Attendance::updateOrCreate(
                    ['asn_id' => $asn->id, 'activity_id' => $act->id],
                    [
                        'attended_at' => $act->date->copy()->setTime(9, rand(5, 35)),
                        'platform' => $i % 3 === 0 ? 'youtube' : 'zoom',
                        'ip_address' => '10.15.'.rand(1, 50).'.'.rand(10, 200),
                        'user_agent' => $i % 2 === 0 ? 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7)' : 'Mozilla/5.0 (Linux; Android 14)',
                    ]
                );

                if ($act->status === 'completed' || ($act->status === 'ongoing' && $i < 12)) {
                    // 2. Pre-test
                    $pretestScore = rand(50, 80);
                    AssessmentAttempt::updateOrCreate(
                        ['asn_id' => $asn->id, 'activity_id' => $act->id, 'type' => 'pretest'],
                        [
                            'score' => $pretestScore,
                            'total_questions' => 5,
                            'correct_answers_count' => (int) round($pretestScore / 20),
                            'is_passed' => true,
                            'started_at' => $act->date->copy()->setTime(9, rand(5, 10)),
                            'finished_at' => $act->date->copy()->setTime(9, rand(15, 25)),
                        ]
                    );

                    // 3. Post-test (mostly passed)
                    $posttestScore = rand(65, 100);
                    $isPassed = $posttestScore >= ($act->passing_grade ?? 70);
                    AssessmentAttempt::updateOrCreate(
                        ['asn_id' => $asn->id, 'activity_id' => $act->id, 'type' => 'posttest'],
                        [
                            'score' => $posttestScore,
                            'total_questions' => 5,
                            'correct_answers_count' => (int) round($posttestScore / 20),
                            'is_passed' => $isPassed,
                            'started_at' => $act->date->copy()->setTime(11, rand(20, 30)),
                            'finished_at' => $act->date->copy()->setTime(11, rand(35, 50)),
                        ]
                    );

                    // 4. Evaluation
                    $feedbackSamples = [
                        'Materi sangat aplikatif dan membuka wawasan penerapan AI dalam tugas ASN sehari-hari.',
                        'Penyampaian narasumber sangat lugas, jelas, dan interaktif. Sangat bermanfaat.',
                        'Sangat bagus, perlu diperbanyak studi kasus riil di lingkup dinas/OPD Kota Padang.',
                        'Fasilitas Zoom dan live streaming lancar, materi dapat diunduh dengan mudah.',
                        'Program Rabu Belajar sangat membantu ASN mengumpulkan jam pelajaran (JP) secara fleksibel.',
                    ];

                    Evaluation::updateOrCreate(
                        ['asn_id' => $asn->id, 'activity_id' => $act->id],
                        [
                            'material_rating' => rand(4, 5),
                            'speaker_rating' => rand(4, 5),
                            'organizer_rating' => rand(4, 5),
                            'feedback_text' => $feedbackSamples[$i % count($feedbackSamples)],
                            'submitted_at' => $act->date->copy()->setTime(11, rand(50, 58)),
                        ]
                    );

                    // 5. Certificate (if passed)
                    if ($isPassed && $act->status === 'completed') {
                        $certCount = Certificate::where('activity_id', $act->id)->count() + 1;
                        $certNumber = sprintf('BKPSDM-RB/%s/%03d/%05d', $act->date->format('Y'), $act->id, $certCount);

                        Certificate::updateOrCreate(
                            ['asn_id' => $asn->id, 'activity_id' => $act->id],
                            [
                                'certificate_number' => $certNumber,
                                'issued_at' => $act->date->copy()->setTime(12, rand(0, 30)),
                            ]
                        );
                    }
                }
            }
        }
    }
}
