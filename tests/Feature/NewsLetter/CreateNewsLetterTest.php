<?php

use App\Models\NewsLetter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Database\Factories\NewsLetterFactory;

uses(RefreshDatabase::class);

it('can create a newsletter by guest users', function () {
    $newsLetterData = NewsLetterFactory::new()->create()->toArray();

    $response = $this->post(route('newsLetter.store'), $newsLetterData);
    $this->assertDatabaseHas('news_letters', [
        'name' => $newsLetterData['name'],
        'email' => $newsLetterData['email'],
    ]);
    $response->assertStatus(302);
    expect(NewsLetter::count())->toBe(2);
});


