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

it('can delete a static page', function () {
    $pageToDelete = StaticPage::factory()->create();

    $response = $this->delete(route('static-pages.destroy', $pageToDelete));

    $response->assertStatus(302);
    $response->assertRedirect(route('static-pages.index'));
    $this->assertDatabaseMissing('static_pages', ['id' => $pageToDelete->id]);
    expect(StaticPage::count())->toBe(0);
});

it('can not delete a static page if user is not admin', function () {
    $this->actingAs(User::factory()->create([
        'is_admin' => 0
    ]));
    
    $pageToDelete = StaticPage::factory()->create();

    $response = $this->delete(route('static-pages.destroy', $pageToDelete));
    $response->assertStatus(403);
    $this->assertDatabaseHas('static_pages', ['id' => $pageToDelete->id]);
    expect(StaticPage::count())->toBe(1);
});

it('can not delete a static page without authentication', function () {
    $this->post(route('logout'));
    
    $pageToDelete = StaticPage::factory()->create();

    $response = $this->delete(route('static-pages.destroy', $pageToDelete));
    $response->assertStatus(302);
    $response->assertRedirect(route('login'));
    $this->assertDatabaseHas('static_pages', ['id' => $pageToDelete->id]);
    expect(StaticPage::count())->toBe(1);
});
