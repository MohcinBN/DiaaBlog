<?php

namespace Database\Factories;

use App\Models\Photo;
use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $order = 1;
        $width = 600;
        $height = 400;
        
        return [
            'photo_id' => Photo::factory(),
            'path' => "https://placehold.co/{$width}x{$height}/EEE/31343C?text=Gallery+Image+{$order}",
            'is_primary' => $order === 1,
            'order' => $order++
        ];
    }

    /**
     * Indicate that the image is primary.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function primary()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_primary' => true,
                'order' => 1
            ];
        });
    }
}
