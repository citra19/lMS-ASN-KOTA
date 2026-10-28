<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Admin User BKPSDM
        User::updateOrCreate(
            ['email' => 'admin@bkpsdm.padang.go.id'],
            [
                'name' => 'Administrator BKPSDM',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
            ]
        );

        // 2. Default Website Settings (Sesuai Proposal Resmi BKPSDM Padang)
        $settings = [
            'site_title' => 'LMS Rabu Belajar Kota Padang',
            'site_tagline' => 'Pusat Informasi & Sarana Pembelajaran Daring ASN Pemerintah Kota Padang',
            'agency_name' => 'Badan Kepegawaian dan Pengembangan Sumber Daya Manusia Kota Padang',
            'parent_agency' => 'Pemerintah Kota Padang',
            'address' => 'Jalan Bagindo Aziz Chan By Pass No.1 Aie Pacah Padang, Kode Pos 25176',
            'phone' => '(0751) 462209',
            'fax' => '(0751) 462205',
            'email' => 'bkd.pdg@gmail.com',
            'website' => 'https://bkd.padang.go.id',
            'head_officer_name' => 'TARMIZI ISMAIL, S.Sos., M.Si',
            'head_officer_nip' => '196803031989021003',
            'head_officer_title' => 'Plt. Kepala BKPSDM Kota Padang (Pembina Utama Muda)',
            'about_summary' => 'Website LMS Rabu Belajar merupakan sarana pembelajaran daring bagi Aparatur Sipil Negara (ASN) di lingkungan Pemerintah Kota Padang. Sebagai pusat akses terintegrasi siaran YouTube, Zoom Meeting, Pre-Test, Virtual Background, Google Form Absensi & Evaluasi, Bahan Belajar, dan E-Sertifikat untuk mendukung pengembangan kompetensi berkelanjutan.',
        ];

        foreach ($settings as $key => $value) {
            Setting::set($key, $value);
        }

        // 3. Call Seeders
        $this->call([
            ActivitySeeder::class,
            QuestionSeeder::class,
        ]);
    }
}
