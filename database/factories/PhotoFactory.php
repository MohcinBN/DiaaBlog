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
        $themes = ['Nature', 'City', 'Architecture', 'People', 'Travel', 'Food', 'Art'];
        $theme = fake()->randomElement($themes);
        
        return [
            'title' => $theme . ' Gallery - ' . fake()->words(3, true),
            'caption' => fake()->paragraph(2),
            'user_id' => User::factory(),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Photo $photo) {
            // Create 4-8 images for each gallery
            $photo->images()->createMany(
                collect(range(1, fake()->numberBetween(4, 8)))->map(function ($index) {
                    $width = 600;
                    $height = 400;
                    return [
                        'path' => "https://placehold.co/{$width}x{$height}/EEE/31343C?text=Gallery+Image+{$index}",
                        'is_primary' => $index === 1,
                        'order' => $index
                    ];
                })->all()
            );
        });
    }
}
