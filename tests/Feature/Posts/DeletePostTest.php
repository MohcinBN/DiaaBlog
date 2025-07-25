<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->actingAs(User::factory()->create());
});

it('can delete a post', function () {
    $postToDelete = Post::factory()->create();

    $response = $this->delete(route('posts.destroy', $postToDelete));

    $response->assertStatus(302);
    $response->assertRedirect(route('posts.index'));
    expect(Post::count())->toBe(0);
});

it('can not delete a post without authentication', function () {
    $this->post(route('logout'));
    $postToDelete = Post::factory()->create();

    $response = $this->delete(route('posts.destroy', $postToDelete));
    $response->assertStatus(302);
    $response->assertRedirect(route('login'));
    expect(Post::count())->toBe(1);
});

