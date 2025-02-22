<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Photo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Photo>
 */
class PhotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'url' => 'https://placehold.co/600x400/EEE/31343C',
            'caption' => fake()->paragraph(),
            'user_id' => User::factory(),
        ];
    }
}
