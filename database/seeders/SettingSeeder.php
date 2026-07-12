<?php

namespace Database\Seeders;

use App\Models\Setting; // <-- Import model
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::firstOrCreate(
            ['key' => 'Visi'],
            ['value' => '(Isi Visi HIMSI Anda di sini. Ganti teks ini dari Admin Panel.)']
        );

        Setting::firstOrCreate(
            ['key' => 'Misi'],
            ['value' => "<ul><li>Isi Misi poin 1 di sini.</li><li>Isi Misi poin 2 di sini.</li><li>Ganti teks ini dari Admin Panel.</li></ul>"]
        );

        Setting::firstOrCreate(
            ['key' => 'wa_humas_1'],                ['value' => '81910833878'] // Masukkan nomor default (tanpa 62 atau 0)
        );

        Setting::firstOrCreate(
            ['key' => 'wa_humas_2'],
            ['value' => '81910833878'] // Masukkan nomor default (tanpa 62 atau 0)
        );
    }
}