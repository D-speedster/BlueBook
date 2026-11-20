<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Publisher;
use App\Models\Category;
use Illuminate\Database\Seeder;

class BookstoreTestSeeder extends Seeder
{
    public function run(): void
    {
        // ایجاد ناشران
        $nashr = Publisher::create([
            'name' => 'نشر نسل نواندیش',
            'description' => 'ناشر کتاب‌های تخصصی',
            'is_active' => true,
        ]);

        $jangal = Publisher::create([
            'name' => 'نشر جنگل',
            'description' => 'انتشارات جنگل',
            'is_active' => true,
        ]);

        // ایجاد دسته‌بندی
        $programming = Category::firstOrCreate(
            ['slug' => 'برنامه-نویسی'],
            [
                'name' => 'برنامه‌نویسی',
                'description' => 'کتاب‌های برنامه‌نویسی',
                'is_active' => true,
            ]
        );

        // ایجاد کتاب آزمایشی
        $book = Product::create([
            'category_id' => $programming->id,
            'title' => 'آموزش جامع PHP و Laravel',
            'authors' => ['علی احمدی', 'سارا محمدی'],
            'summary' => 'این کتاب یک راهنمای کامل برای یادگیری PHP و فریمورک Laravel است.',
            'description' => 'در این کتاب با مفاهیم پایه PHP شروع کرده و به تدریج با Laravel آشنا می‌شوید. شامل پروژه‌های عملی و مثال‌های کاربردی.',
            'is_active' => true,
        ]);

        // ایجاد نسخه رقعی
        ProductVariant::create([
            'product_id' => $book->id,
            'publisher_id' => $nashr->id,
            'name' => 'نسخه رقعی',
            'size' => 'رقعی',
            'cover_type' => 'شومیز',
            'pages' => 450,
            'edition' => 2,
            'publish_year' => 1402,
            'price' => 185000,
            'stock' => 7,
            'is_published' => true,
        ]);

        // ایجاد نسخه جیبی
        ProductVariant::create([
            'product_id' => $book->id,
            'publisher_id' => $jangal->id,
            'name' => 'نسخه جیبی',
            'size' => 'جیبی',
            'cover_type' => 'شومیز',
            'pages' => 380,
            'edition' => 1,
            'publish_year' => 1402,
            'price' => 125000,
            'stock' => 0, // ناموجود
            'is_published' => true,
        ]);

        $this->command->info('✓ کتاب آزمایشی با دو نسخه ایجاد شد');
        $this->command->info('  - نسخه رقعی: 185,000 تومان (موجود: 7)');
        $this->command->info('  - نسخه جیبی: 125,000 تومان (ناموجود)');
    }
}
