<?php

use App\Models\StaticPage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->actingAs(User::factory()->create([
        'is_admin' => 1
    ]));
});

it('can edit a static page', function () {
    $pageToUpdate = StaticPage::factory()->create();
    $updatedPageData = [
        'title' => 'Updated Page Title',
        'slug' => 'updated-page-slug',
        'content' => 'Updated page content goes here.',
        'is_published' => true,
    ];

    $response = $this->put(route('static-pages.update', $pageToUpdate), $updatedPageData);

    $response->assertStatus(302);
    $response->assertRedirect(route('static-pages.index'));
    $this->assertDatabaseHas('static_pages', [
        'id' => $pageToUpdate->id,
        'title' => 'Updated Page Title',
        'slug' => 'updated-page-slug',
    ]);
    expect(StaticPage::count())->toBe(1);
});

it('can not edit a static page if user is not admin', function () {
    $this->actingAs(User::factory()->create([
        'is_admin' => 0
    ]));
    
    $pageToUpdate = StaticPage::factory()->create();
    $updatedPageData = [
        'title' => 'Updated Page Title',
        'slug' => 'updated-page-slug',
        'content' => 'Updated page content goes here.',
        'is_published' => true,
    ];

    $response = $this->put(route('static-pages.update', $pageToUpdate), $updatedPageData);
    $response->assertStatus(403);
    $this->assertDatabaseMissing('static_pages', [
        'id' => $pageToUpdate->id,
        'title' => 'Updated Page Title',
    ]);
});

it('can not edit a static page without authentication', function () {
    $this->post(route('logout'));

    $pageToUpdate = StaticPage::factory()->create();
    $updatedPageData = [
        'title' => 'Updated Page Title',
        'slug' => 'updated-page-slug',
        'content' => 'Updated page content goes here.',
        'is_published' => true,
    ];

    $response = $this->put(route('static-pages.update', $pageToUpdate), $updatedPageData);
    $response->assertStatus(302);
    $response->assertRedirect(route('login'));
    $this->assertDatabaseMissing('static_pages', [
        'id' => $pageToUpdate->id,
        'title' => 'Updated Page Title',
    ]);
});
