<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->actingAs(User::factory()->create());
});

it('can see posts index page by authenticated user', function () { 
    $mockPosts = Post::factory()->count(6)->create();

    $route = route('posts.index');

    $response = $this->get($route);
    $response->assertViewIs('posts.index');
    expect($response->viewData('posts')->first()->title)->toBe($mockPosts->first()->title);
    $response->assertStatus(200);
});

it('can be paginated', function() {
    $mockPosts = Post::factory()->count(6)->create();

    $route = route('posts.index');
    
    $response = $this->get($route);
    $response->assertViewIs('posts.index');
    expect($mockPosts->count(), $response->viewData('posts')->count())->toBe(6);
    $response->assertStatus(200);
});