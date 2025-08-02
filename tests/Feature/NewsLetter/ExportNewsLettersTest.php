<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\NewsLetter;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->actingAs(User::factory()->create([
        'is_admin' => 1
    ]));

    NewsLetter::factory()->count(3)->create();
});

it('downloads a CSV file with newsletter data', function () {
    NewsLetter::factory()->create([
        'name' => 'John Doe',
        'email' => 'john@example.com',
    ]);

    $response = $this->get(route('newsLetter.export'));

    $response->assertStatus(200);
    $response->assertHeader('Content-Disposition');
    expect($response->headers->get('Content-Disposition'))->toContain('attachment; filename=data.csv');
});


it('cannot export newsletters without authentication', function () {
    $this->post(route('logout'));
    
    $response = $this->get(route('newsLetter.export'));
    $response->assertStatus(302);
    $response->assertRedirect(route('login'));
});
