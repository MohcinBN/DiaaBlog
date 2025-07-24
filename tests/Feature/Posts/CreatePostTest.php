<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->actingAs(User::factory()->create());
});

it('can create a post', function () {
    $postData = Post::factory()->create()->toArray();

    $response = $this->post(route('posts.store'), $postData);
    $this->assertDatabaseHas('posts', [
        'title' => $postData['title'],
        'slug' => $postData['slug'],
        'content' => $postData['content'],
        'featured_image' => $postData['featured_image'],
        'user_id' => $postData['user_id'],
    ]);
    $response->assertStatus(302);
    expect(Post::count())->toBe(1);
});

it('can not create a post without missing required one or multiple fields', function () {
    $postData = Post::factory()->make()->toArray();
    unset($postData['title'], $postData['content']);

    $response = $this->post(route('posts.store'), $postData);
    $response->assertSessionHasErrors('title', 'content');
    $response->assertStatus(302);
    expect(Post::count())->toBe(0);
});

it('can not create a post with wrong image type', function () {
    $postData = Post::factory()->make()->toArray();
    $postData['featured_image'] = 'wrong_image_type.svg';

    $response = $this->post(route('posts.store'), $postData);
    $response->assertSessionHasErrors('featured_image');
    $response->assertStatus(302);
    expect(Post::count())->toBe(0);
});

it('can not create a post without authentication', function () {
    $this->post(route('logout')); 

    $response = $this->get(route('posts.create'));
    $response->assertStatus(302);
    $response->assertRedirect(route('login'));
    expect(Post::count())->toBe(0);
});


