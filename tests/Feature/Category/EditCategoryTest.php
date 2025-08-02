<?php

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->actingAs(User::factory()->create([
        'is_admin' => 1
    ]));
});

it('can edit a category', function () {
    $categoryToUpdate = Category::factory()->create();
    $updatedCategoryData = [
        'name' => 'Updated Category',
        'slug' => 'updated-category',
    ];

    $response = $this->put(route('category.update', $categoryToUpdate), $updatedCategoryData);

    $response->assertStatus(302);
    $response->assertRedirect(route('categories.index'));
    expect(Category::count())->toBe(1);
});

it('can not edit a category without if user is not admin', function () {
    $this->actingAs(User::factory()->create([
        'is_admin' => 0
    ]));
    
    $categoryToUpdate = Category::factory()->create();
    $updatedCategoryData = [
        'name' => 'Updated Category',
        'slug' => 'updated-category',
    ];

    $response = $this->put(route('category.update', $categoryToUpdate), $updatedCategoryData);
    $response->assertStatus(403);
    expect(Category::count())->toBe(1);
});

it('can not edit a category without authentication', function () {
    $this->post(route('logout'));

    $categoryToUpdate = Category::factory()->create();
    $updatedCategoryData = [
        'name' => 'Updated Category',
        'slug' => 'updated-category',
    ];

    $response = $this->put(route('category.update', $categoryToUpdate), $updatedCategoryData);
    $response->assertStatus(302);
    $response->assertRedirect(route('login'));
    expect(Category::count())->toBe(1);
});
