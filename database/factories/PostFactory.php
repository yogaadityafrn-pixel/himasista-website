<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User; // <-- Import User

class PostFactory extends Factory
{
    public function definition(): array
    {
        $title = $this->faker->sentence(6); // Buat 6 kata judul
        $slug = Str::slug($title);
        
        return [
            // Ambil user ID secara acak (kita asumsikan ID 1, 2, 3 ada)
            'user_id' => User::inRandomOrder()->first()->id ?? 1,
            'title' => $title,
            'slug' => $slug,
            'content' => '<p>' . $this->faker->paragraphs(5, true) . '</p>', // 5 paragraf
            'image' => 'post-images/dummy.png', // Kita pakai 1 gambar placeholder
            'status' => 'published',
            'published_at' => $this->faker->dateTimeBetween('-1 month', 'now'), // Antara 1 bulan lalu - sekarang
        ];
    }
}