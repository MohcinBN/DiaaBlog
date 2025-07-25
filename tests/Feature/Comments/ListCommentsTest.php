<?php

use App\Models\Comment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->actingAs(User::factory()->create());
});

it('can list comments by admin', function () {
    $comment = Comment::factory()->create();

    $response = $this->get(route('comments.index'));
    $response->assertViewIs('comments.index');
    expect($response->viewData('comments')->first()->content)->toBe($comment->content);
    $response->assertStatus(200);
});

it('can be paginated', function() {
    $comments = Comment::factory()->count(10)->create();

    $route = route('comments.index');
    
    $response = $this->get($route);
    $response->assertViewIs('comments.index');
    expect($comments->count(), $response->viewData('comments')->count())->toBe(10);
    $response->assertStatus(200);
});

it('can not see list comments by non authenticated user', function () {
    $this->post(route('logout'));

    $response = $this->get(route('comments.index'));
    $response->assertStatus(500);
});