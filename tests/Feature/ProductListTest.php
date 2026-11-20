<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductListTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_list_is_paginated(): void
    {
        // Create 25 products (more than 12 per page)
        Product::factory()->count(25)->create(['is_active' => true]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewHas('products');
        
        $products = $response->viewData('products');
        $this->assertEquals(12, $products->count());
        $this->assertEquals(25, $products->total());
    }

    public function test_product_list_has_eager_loading(): void
    {
        $category = Category::factory()->create();
        Product::factory()->count(5)->create([
            'category_id' => $category->id,
            'is_active' => true,
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        
        // Check that category is eager loaded (no N+1 query)
        $products = $response->viewData('products');
        $this->assertTrue($products->first()->relationLoaded('category'));
    }

    public function test_only_active_products_are_shown(): void
    {
        Product::factory()->count(5)->create(['is_active' => true]);
        Product::factory()->count(3)->create(['is_active' => false]);

        $response = $this->get('/');

        $products = $response->viewData('products');
        $this->assertEquals(5, $products->total());
    }

    public function test_category_filter_works(): void
    {
        $category1 = Category::factory()->create(['slug' => 'کتاب']);
        $category2 = Category::factory()->create(['slug' => 'دوره']);

        Product::factory()->count(3)->create([
            'category_id' => $category1->id,
            'is_active' => true,
        ]);
        Product::factory()->count(2)->create([
            'category_id' => $category2->id,
            'is_active' => true,
        ]);

        $response = $this->get('/category/کتاب');

        $products = $response->viewData('products');
        $this->assertEquals(3, $products->total());
    }
}
