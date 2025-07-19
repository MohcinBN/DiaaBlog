<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use App\Models\Video;
use App\Models\Photo;
use App\Models\Comment;
use App\Models\Image;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a single user with specific credentials
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ])->each(function ($user) {
            // Each user creates 3-5 posts
            Post::factory(fake()->numberBetween(3, 5))->create([
                'user_id' => $user->id
            ])->each(function ($post) use ($user) {  
                // Each post gets 2-6 comments
                Comment::factory(fake()->numberBetween(2, 6))->create([
                    'post_id' => $post->id,
                    'user_id' => fake()->boolean(70) ? $user->id : null // 70% chance of user comment, 30% guest
                ]);
            });

            // Each user creates 2-4 videos
            Video::factory(fake()->numberBetween(2, 4))->create([
                'user_id' => $user->id
            ]);

            // Each user creates 2-3 photo galleries
            Photo::factory(fake()->numberBetween(2, 3))->create([
                'user_id' => $user->id
            ]);
        });
    }
}
