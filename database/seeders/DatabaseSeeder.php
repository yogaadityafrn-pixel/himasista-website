<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// vvv IMPORT MODELNYA vvv
use App\Models\Post;
use App\Models\Event;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Panggil seeder kustom kita (PENTING)
        $this->call([
            SettingSeeder::class,
            UserSeeder::class,
        ]);

        // Hanya jalankan factory jika database masih kosong
        if (Post::count() == 0) {
            Post::factory(20)->create(); // Buat 12 berita dummy
        }
        
        if (Event::count() == 0) {
            Event::factory(10)->create(); // Buat 5 acara dummy
        }
    }
}