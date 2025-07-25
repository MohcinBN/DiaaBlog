<?php

use App\Models\Comment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can add a comment', function () {
    $comment = Comment::factory()->create()->toArray();

    $response = $this->post(route('comments.store'), $comment);
    $this->assertDatabaseHas('comments', [
        'name' => $comment['name'],
        'content' => $comment['content'],
        'post_id' => $comment['post_id'],
        'user_id' => $comment['user_id'],
    ]);
    $response->assertStatus(302);
    expect(Comment::count())->toBe(2);
});

it('can not add a comment if validation fails', function () {
    $comment = Comment::factory()->create()->toArray();
    unset($comment['name'], $comment['content']);

    $response = $this->post(route('comments.store'), $comment);
    $response->assertSessionHasErrors('name', 'content');
    $response->assertStatus(302);
    expect(Comment::count())->toBe(1);
});
    
