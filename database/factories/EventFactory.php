<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User; // <-- Import User

class EventFactory extends Factory
{
    public function definition(): array
    {
        $title = 'Acara: ' . $this->faker->words(4, true);
        $slug = Str::slug($title);
        
        return [
            'user_id' => User::inRandomOrder()->first()->id ?? 1,
            'title' => $title,
            'slug' => $slug,
            'description' => '<p>' . $this->faker->paragraphs(3, true) . '</p>',
            'start_time' => $this->faker->dateTimeBetween('now', '+1 month'), // Acara di masa depan
            'location' => $this->faker->city . ', ' . $this->faker->streetName,
            'image' => 'event-images/dummy.png', // Kita pakai 1 gambar placeholder
            'status' => 'upcoming',
        ];
    }
}