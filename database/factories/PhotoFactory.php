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
            'slug' => fake()->slug(3),
            'caption' => fake()->paragraph(2),
            'user_id' => User::factory(),
            'images' => json_encode(
                $this->faker->randomElements(
                [
                    $this->faker->imageUrl(640, 480, 'nature'),
                    $this->faker->imageUrl(640, 480, 'city'),
                    $this->faker->imageUrl(640, 480, 'architecture'),
                    $this->faker->imageUrl(640, 480, 'people'),
                    $this->faker->imageUrl(640, 480, 'travel'),
                ],
                rand(3, 5)
            )),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this;
    }
}
