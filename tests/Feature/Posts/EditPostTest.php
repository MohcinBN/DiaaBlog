<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->actingAs(User::factory()->create());
    \App\Models\Category::factory()->create(['id' => 1]);
});

it('can edit a post', function () {
    $postToUpdate = Post::factory()->create();

    $response = $this->put(route('posts.update', $postToUpdate), [
        'title' => 'Updated Title',
        'content' => 'Updated content for the post',
        'categories' => [1]
    ]);

    $response->assertStatus(302);
    $response->assertRedirect(route('posts.index'));
    expect(Post::count())->toBe(1);
});

it('can not edit a post without authentication', function () {
    $this->post(route('logout'));
    $postToUpdate = Post::factory()->create();

    $response = $this->put(route('posts.update', $postToUpdate));
    $response->assertStatus(302);
    $response->assertRedirect(route('login'));
    expect(Post::count())->toBe(1);
});
