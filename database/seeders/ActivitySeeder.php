<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $activities = [
            [
                'title' => 'Rabu Belajar Seri #24: Transformasi Digital Birokrasi & Pemanfaatan AI untuk Produktivitas ASN',
                'slug' => 'rabu-belajar-seri-24-transformasi-digital-dan-ai',
                'theme' => 'Akselerasi Efisiensi Pelayanan Publik Melalui Pemanfaatan Artificial Intelligence yang Beretika',
                'speaker_name' => 'Dr. H. Hendri Suwarno, M.Eng., Sc.',
                'speaker_title' => 'Tenaga Ahli Digitalisasi Birokrasi & Transformasi Pemerintahan',
                'date' => now()->toDateString(),
                'start_time' => '09:00:00',
                'end_time' => '12:00:00',
                'description' => 'Kegiatan rutin mingguan Rabu Belajar BKPSDM Kota Padang yang membahas implementasi teknologi informasi, otomasi kerja birokrasi, serta panduan praktis pemanfaatan AI generatif untuk penyusunan naskah dinas dan analisis data di lingkungan OPD Pemerintah Kota Padang.',
                'youtube_url' => 'https://www.youtube.com/watch?v=live_stream_bkpsdm_padang',
                'zoom_url' => 'https://zoom.us/j/8834920192?pwd=BKPSDMPADANG2026',
                'zoom_meeting_id' => '883 4920 1928',
                'zoom_passcode' => 'RABU2026',
                'pretest_url' => 'https://forms.gle/samplePreTestRabuBelajar24',
                'virtual_background' => null,
                'google_form_url' => 'https://forms.gle/samplePostTestAbsenEval24',
                'material_url' => 'https://drive.google.com/drive/folders/sample_materi_rabu_belajar_24',
                'certificate_url' => 'https://bkpsdm.padang.go.id/e-sertifikat/rabu-24',
                'is_published' => true,
                'status' => 'ongoing',
                'views_count' => 342,
            ],
            [
                'title' => 'Rabu Belajar Seri #25: Penerapan Core Values ASN BerAKHLAK dalam Menghadapi Pengaduan Publik',
                'slug' => 'rabu-belajar-seri-25-core-values-berakhlak',
                'theme' => 'Mewujudkan Budaya Pelayanan Prima dan Responsif bagi Aparatur Sipil Negara Kota Padang',
                'speaker_name' => 'Dra. Hj. Nurainun Lubis, M.Si.',
                'speaker_title' => 'Widyaiswara Ahli Utama BPSDM Provinsi Sumatera Barat',
                'date' => now()->addDays(7)->toDateString(),
                'start_time' => '09:00:00',
                'end_time' => '11:30:00',
                'description' => 'Pendalaman nilai-nilai Berorientasi Pelayanan, Akuntabel, Kompeten, Harmonis, Loyal, Adaptif, dan Kolaboratif (BerAKHLAK) dalam praktik kerja harian serta studi kasus pengelolaan komplain warga di Kota Padang.',
                'youtube_url' => 'https://www.youtube.com/@bkpsdmkotapadang',
                'zoom_url' => 'https://zoom.us/j/9921820334?pwd=ASNBERAKHLAK2026',
                'zoom_meeting_id' => '992 1820 3341',
                'zoom_passcode' => 'AKHLAK26',
                'pretest_url' => 'https://forms.gle/samplePreTestRabuBelajar25',
                'virtual_background' => null,
                'google_form_url' => 'https://forms.gle/samplePostTestAbsenEval25',
                'material_url' => 'https://drive.google.com/drive/folders/sample_materi_rabu_belajar_25',
                'certificate_url' => null,
                'is_published' => true,
                'status' => 'upcoming',
                'views_count' => 128,
            ],
            [
                'title' => 'Rabu Belajar Seri #23: Optimalisasi Penyusunan SKP & Penilaian Kinerja JF Terintegrasi',
                'slug' => 'rabu-belajar-seri-23-penyusunan-skp-jf',
                'theme' => 'Panduan Teknis Penilaian Kinerja Pegawai dan Angka Kredit Jabatan Fungsional Terpadu',
                'speaker_name' => 'Rizki Pratama, S.STP., M.A.P.',
                'speaker_title' => 'Analis Kepegawaian Muda Kantor Regional XII BKN',
                'date' => now()->subDays(7)->toDateString(),
                'start_time' => '09:00:00',
                'end_time' => '12:00:00',
                'description' => 'Bedah teknis PermenPANRB terkait penetapan SKP pejabat fungsional, integrasi e-Kinerja BKN, serta kiat praktis pengisian bukti dukung capaian output kerja.',
                'youtube_url' => 'https://www.youtube.com/watch?v=archive_skp_2026',
                'zoom_url' => 'https://zoom.us/j/7728192019',
                'zoom_meeting_id' => '772 8192 0192',
                'zoom_passcode' => 'SKP2026',
                'pretest_url' => 'https://forms.gle/samplePreTest23',
                'virtual_background' => null,
                'google_form_url' => 'https://forms.gle/sampleGoogleForm23',
                'material_url' => 'https://drive.google.com/drive/folders/sample_materi_skp_23',
                'certificate_url' => 'https://bkpsdm.padang.go.id/sertifikat-digital/seri-23-download',
                'is_published' => true,
                'status' => 'completed',
                'views_count' => 615,
            ],
            [
                'title' => 'Rabu Belajar Seri #22: Tata Kelola Kearsipan Digital dan Manajemen Naskah Dinas Elektronik (TNDE)',
                'slug' => 'rabu-belajar-seri-22-kearsipan-digital-tnde',
                'theme' => 'Penguatan Ekosistem SPBE Melalui Pengelolaan Arsip Dinamis dan Surat Masuk/Keluar Digital',
                'speaker_name' => 'Fajri Ramadhan, S.Hum., M.Si.',
                'speaker_title' => 'Arsiparis Madya Dinas Perpustakaan dan Kearsipan Kota Padang',
                'date' => now()->subDays(14)->toDateString(),
                'start_time' => '09:00:00',
                'end_time' => '11:45:00',
                'description' => 'Materi pelatihan praktis aplikasi SRIKANDI (Sistem Informasi Kearsipan Dinamis Terintegrasi) dan standarisasi tata persuratan dinas pemkot Padang.',
                'youtube_url' => 'https://www.youtube.com/watch?v=archive_tnde_srikandi',
                'zoom_url' => 'https://zoom.us/j/6628192837',
                'zoom_meeting_id' => '662 8192 8371',
                'zoom_passcode' => 'SRIKANDI26',
                'pretest_url' => 'https://forms.gle/samplePreTest22',
                'virtual_background' => null,
                'google_form_url' => 'https://forms.gle/sampleGoogleForm22',
                'material_url' => 'https://drive.google.com/drive/folders/sample_materi_srikandi_22',
                'certificate_url' => 'https://bkpsdm.padang.go.id/sertifikat-digital/seri-22-download',
                'is_published' => true,
                'status' => 'completed',
                'views_count' => 482,
            ],
        ];

        foreach ($activities as $data) {
            Activity::updateOrCreate(['slug' => $data['slug']], $data);
        }
    }
}
