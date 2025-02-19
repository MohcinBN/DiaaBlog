<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Video>
 */
class VideoFactory extends Factory
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
            'url' => 'https://www.youtube.com/watch?v=' . fake()->regexify('[A-Za-z0-9]{11}'),
            'description' => fake()->paragraphs(2, true),
            'user_id' => User::factory(),
        ];
    }
}
