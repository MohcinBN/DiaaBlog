<?php

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Database\Factories\CategoryFactory;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->actingAs(User::factory()->create([
        'is_admin' => 1
    ]));
});

it('can create a category', function () {
    $categoryData = CategoryFactory::new()->create()->toArray();

    $response = $this->post(route('category.store'), $categoryData);
    $this->assertDatabaseHas('categories', [
        'name' => $categoryData['name'],
        'slug' => $categoryData['slug'],
    ]);
    $response->assertStatus(302);
    expect(Category::count())->toBe(1);
});

it('can not create a category without missing required one or multiple fields', function () {
    $categoryData = CategoryFactory::new()->make()->toArray();
    unset($categoryData['name'], $categoryData['slug']);

    $response = $this->post(route('category.store'), $categoryData);
    $response->assertSessionHasErrors('name', 'slug');
    $response->assertStatus(302);
    expect(Category::count())->toBe(0);
});

it('can not create a category without authentication', function () {
    $this->post(route('logout'));    

    $response = $this->post(route('category.store'), CategoryFactory::new()->make()->toArray());
    $response->assertStatus(302);
    $response->assertRedirect(route('login'));
    expect(Category::count())->toBe(0);
});


