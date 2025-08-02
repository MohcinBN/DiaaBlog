<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->actingAs(User::factory()->create([
        'is_admin' => 1
    ]));
});

it('can list newsletters by admin', function () {
    $response = $this->get(route('newsLetters.index'));
    $response->assertStatus(200);
});


