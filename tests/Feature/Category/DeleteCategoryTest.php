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

it('can delete a category', function () {
    $categoryToDelete = Category::factory()->create();

    $response = $this->delete(route('category.destroy', $categoryToDelete));

    $response->assertStatus(302);
    $response->assertRedirect(route('categories.index'));
    expect(Category::count())->toBe(0);
});

it('can not delete a category without if user is not admin', function () {
    $this->actingAs(User::factory()->create([
        'is_admin' => 0
    ]));
    
    $categoryToDelete = Category::factory()->create();

    $response = $this->delete(route('category.destroy', $categoryToDelete));
    $response->assertStatus(403);
    expect(Category::count())->toBe(1);
});

it('can not delete a category without authentication', function () {
    $this->post(route('logout'));
    
    $categoryToDelete = Category::factory()->create();

    $response = $this->delete(route('category.destroy', $categoryToDelete));
    $response->assertStatus(302);
    $response->assertRedirect(route('login'));
    expect(Category::count())->toBe(1);
});
