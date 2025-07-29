<?php

use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can add a reply on exiting comments', function () {
    $comment = Comment::factory()->create()->toArray();

    $response = $this->post(route('comments.reply.store'), $comment);
    $this->assertDatabaseHas('comments', [
        'name' => $comment['name'],
        'content' => $comment['content'],
        'post_id' => $comment['post_id'],
        'user_id' => $comment['user_id'],
        'parent_id' => $comment['parent_id'],
    ]);
    $response->assertStatus(302);
    expect(Comment::count())->toBe(1);
});