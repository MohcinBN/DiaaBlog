<?php

use App\Models\StaticPage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Database\Factories\StaticPageFactory;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->actingAs(User::factory()->create([
        'is_admin' => 1
    ]));
});

it('can create a static page', function () {
    $pageData = StaticPageFactory::new()->make()->toArray();

    $response = $this->post(route('static-pages.store'), $pageData);
    $this->assertDatabaseHas('static_pages', [
        'title' => $pageData['title'],
        'slug' => $pageData['slug'],
        'content' => $pageData['content'],
    ]);
    $response->assertStatus(302);
    $response->assertRedirect(route('static-pages.index'));
    expect(StaticPage::count())->toBe(1);
});

it('can not create a static page with missing required fields', function () {
    $pageData = StaticPageFactory::new()->make()->toArray();
    unset($pageData['title'], $pageData['content']);

    $response = $this->post(route('static-pages.store'), $pageData);
    $response->assertSessionHasErrors(['title', 'content']);
    $response->assertStatus(302);
    expect(StaticPage::count())->toBe(0);
});

it('can not create a static page if user is not admin', function () {
    $this->actingAs(User::factory()->create([
        'is_admin' => 0
    ]));
    
    $pageData = StaticPageFactory::new()->make()->toArray();

    $response = $this->post(route('static-pages.store'), $pageData);
    $response->assertStatus(403);
    expect(StaticPage::count())->toBe(0);
});

it('can not create a static page without authentication', function () {
    $this->post(route('logout'));    

    $response = $this->post(route('static-pages.store'), StaticPageFactory::new()->make()->toArray());
    $response->assertStatus(302);
    $response->assertRedirect(route('login'));
    expect(StaticPage::count())->toBe(0);
});
