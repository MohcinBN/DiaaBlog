<?php

use App\Models\Comment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->actingAs(User::factory()->create());
});

it('can approve a comment by admin', function () {
    $comment = Comment::factory()->create();

    $response = $this->put(route('comments.approve', $comment));
    $response->assertStatus(302);
    expect(Comment::count())->toBe(1);
});

it('can not approve a comment by non admin', function () {
    $this->post(route('logout'));
    $comment = Comment::factory()->create();

    $response = $this->put(route('comments.approve', $comment));
    $response->assertStatus(403);
});