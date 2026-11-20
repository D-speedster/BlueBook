<?php

namespace Tests\Feature;

use App\Helpers\SlugHelper;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SlugTest extends TestCase
{
    use RefreshDatabase;

    public function test_persian_slug_is_generated_correctly(): void
    {
        $slug = SlugHelper::make('کتاب لاراول');
        
        $this->assertEquals('کتاب-لاراول', $slug);
        $this->assertStringNotContainsString(' ', $slug);
    }

    public function test_slug_preserves_zwnj(): void
    {
        $slug = SlugHelper::make('کتاب‌ها');
        
        // نیم‌فاصله (U+200C) باید حفظ شود
        $this->assertEquals('کتاب‌ها', $slug);
        $this->assertStringContainsString("\u{200C}", $slug);
    }

    public function test_slug_handles_special_characters(): void
    {
        $slug = SlugHelper::make('کتاب: راهنمای کامل!');
        
        $this->assertEquals('کتاب-راهنمای-کامل', $slug);
    }

    public function test_category_slug_is_unique(): void
    {
        Category::create([
            'name' => 'کتاب‌ها',
            'slug' => 'کتاب‌ها',
            'is_active' => true,
        ]);

        $category2 = Category::create([
            'name' => 'کتاب‌ها',
            'is_active' => true,
        ]);

        $this->assertNotEquals('کتاب‌ها', $category2->slug);
        $this->assertStringStartsWith('کتاب‌ها-', $category2->slug);
    }

    public function test_product_slug_is_auto_generated(): void
    {
        $product = Product::create([
            'title' => 'کتاب برنامه‌نویسی',
            'price' => 100000,
            'stock' => 10,
            'is_active' => true,
        ]);

        $this->assertEquals('کتاب-برنامه‌نویسی', $product->slug);
    }

    public function test_product_slug_is_unique(): void
    {
        Product::create([
            'title' => 'کتاب',
            'slug' => 'کتاب',
            'price' => 100000,
            'stock' => 10,
            'is_active' => true,
        ]);

        $product2 = Product::create([
            'title' => 'کتاب',
            'price' => 200000,
            'stock' => 5,
            'is_active' => true,
        ]);

        $this->assertNotEquals('کتاب', $product2->slug);
        $this->assertEquals('کتاب-1', $product2->slug);
    }
}
