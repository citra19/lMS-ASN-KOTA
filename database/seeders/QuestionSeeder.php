<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $activities = Activity::all();

        $sampleQuestions = [
            [
                'question_text' => 'Apa tujuan utama dari implementasi Sistem Pemerintahan Berbasis Elektronik (SPBE) di Pemerintah Kota Padang?',
                'options' => [
                    'A' => 'Mengurangi jumlah pegawai secara drastis',
                    'B' => 'Mewujudkan tata kelola pemerintahan yang bersih, efektif, transparan, dan akuntabel',
                    'C' => 'Mewajibkan warga membeli perangkat komputer',
                    'D' => 'Menghilangkan seluruh arsip fisik tanpa cadangan',
                ],
                'correct_answer' => 'B',
                'explanation' => 'Tujuan utama SPBE adalah meningkatkan kualitas tata kelola pemerintahan yang bersih, efektif, dan akuntabel berbasis digital.',
            ],
            [
                'question_text' => 'Nilai dasar ASN "BerAKHLAK" yang menekankan komitmen memberikan pelayanan prima demi kepuasan masyarakat adalah...',
                'options' => [
                    'A' => 'Akuntabel',
                    'B' => 'Kompeten',
                    'C' => 'Berorientasi Pelayanan',
                    'D' => 'Harmonis',
                ],
                'correct_answer' => 'C',
                'explanation' => 'Berorientasi Pelayanan berarti ASN berkomitmen memberikan pelayanan prima demi kepuasan penerima layanan.',
            ],
            [
                'question_text' => 'Berikut yang BUKAN merupakan prinsip keamanan informasi saat ASN bekerja secara daring (remote/digital) adalah...',
                'options' => [
                    'A' => 'Menggunakan kata sandi yang kuat dan unik',
                    'B' => 'Membagikan akun login SSO kedinasan kepada rekan sejawat untuk efisiensi',
                    'C' => 'Mengaktifkan otentikasi dua faktor jika tersedia',
                    'D' => 'Tidak mengakses dokumen rahasia melalui jaringan Wi-Fi publik tanpa proteksi',
                ],
                'correct_answer' => 'B',
                'explanation' => 'Akun kedinasan bersifat individual dan rahasia, tidak boleh dipindahtangankan atau dibagikan kepada pihak lain.',
            ],
            [
                'question_text' => 'Dalam konsep Transformasi Digital, pilar yang paling krusial selain kesiapan teknologi (tools) adalah kesiapan...',
                'options' => [
                    'A' => 'Jumlah gedung kantor',
                    'B' => 'Budaya kerja dan kompetensi Sumber Daya Manusia (SDM)',
                    'C' => 'Merk laptop yang seragam',
                    'D' => 'Warna seragam dinas',
                ],
                'correct_answer' => 'B',
                'explanation' => 'Kunci keberhasilan transformasi digital adalah perubahan mindset, budaya kerja, dan peningkatan literasi SDM ASN.',
            ],
            [
                'question_text' => 'Minimal jam pelajaran (JP) pengembangan kompetensi yang menjadi hak ASN per tahun berdasarkan regulasi kepegawaian adalah...',
                'options' => [
                    'A' => '5 JP per tahun',
                    'B' => '10 JP per tahun',
                    'C' => '20 JP per tahun',
                    'D' => '50 JP per tahun',
                ],
                'correct_answer' => 'C',
                'explanation' => 'Setiap ASN memiliki hak pengembangan kompetensi sekurang-kurangnya 20 JP setiap tahunnya.',
            ],
        ];

        foreach ($activities as $activity) {
            foreach ($sampleQuestions as $index => $q) {
                Question::updateOrCreate(
                    [
                        'activity_id' => $activity->id,
                        'order' => $index + 1,
                    ],
                    [
                        'type' => 'both', // Bisa dipakai untuk Pre-Test maupun Post-Test
                        'question_text' => $q['question_text'],
                        'options' => $q['options'],
                        'correct_answer' => $q['correct_answer'],
                        'explanation' => $q['explanation'],
                    ]
                );
            }
        }
    }
}
