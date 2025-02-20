<?php

namespace Database\Seeders;


use App\Models\Comment;
use App\Models\Photo;
use App\Models\Post;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ])->each(function($user){
            Post::factory(fake()->numberBetween(2, 4))->create([
                'user_id' => $user->id
                ])->each(function ($post) use ($user)  {
                    Comment::factory(fake()->numberBetween(2, 4))->create([
                        'post_id' => $post->id,
                        'user_id' => $user->id
                        ]);
                })
                ;
            
            Photo::factory(fake()->numberBetween(2, 4))->create([
                    'user_id' => $user->id
                    ]);

            Video::factory(fake()->numberBetween(2, 4))->create([
                        'user_id' => $user->id
                        ]);
                    
                
        });
        
        /*->has(Post::factory()->count(random_int(2, 4)))->has(Comment::factory(random_int(2,3)))
        ->has(Photo::factory()->count(random_int(2, 4)))
        ->has(Video::factory()->count(random_int(2, 4)))
        ->create();*/
    }
}
