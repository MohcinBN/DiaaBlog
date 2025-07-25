<?php

use App\Models\Comment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->actingAs(User::factory()->create());
});

it('can delete a comment', function () {
    $comment = Comment::factory()->create();

    $response = $this->delete(route('comments.destroy', $comment));
    $response->assertStatus(302);
    expect(Comment::count())->toBe(0);
});

it('can not delete a comment if not authenticated', function () {
    $this->post(route('logout'));
    $comment = Comment::factory()->create();

    $response = $this->delete(route('comments.destroy', $comment));
    $response->assertStatus(403);
});

