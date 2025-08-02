<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can embed the form', function () {
    $response = $this->get(route('newsLetter.embed-form'));
    $response->assertStatus(200);
});


