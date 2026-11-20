<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class TestDataSeeder extends Seeder
{
    public function run(): void
    {
        // Create 6 categories
        $categories = [
            [
                'name' => 'برنامه‌نویسی',
                'description' => 'کتاب‌های تخصصی برنامه‌نویسی و فناوری',
            ],
            [
                'name' => 'رمان و داستان',
                'description' => 'آثار ادبی، رمان‌های کلاسیک و معاصر',
            ],
            [
                'name' => 'تاریخ',
                'description' => 'کتاب‌های تاریخی ایران و جهان',
            ],
            [
                'name' => 'روانشناسی',
                'description' => 'روانشناسی عمومی، مشاوره و رشد فردی',
            ],
            [
                'name' => 'کودک و نوجوان',
                'description' => 'کتاب‌های کودکان و نوجوانان',
            ],
            [
                'name' => 'فلسفه',
                'description' => 'فلسفه، منطق و اندیشه',
            ],
        ];

        $createdCategories = [];
        foreach ($categories as $cat) {
            $createdCategories[] = Category::create([
                'name' => $cat['name'],
                'description' => $cat['description'],
                'is_active' => true,
            ]);
        }

        // Create 8 products with varied categories
        $products = [
            [
                'category_id' => $createdCategories[0]->id, // برنامه‌نویسی
                'title' => 'آموزش جامع لاراول',
                'description' => 'از صفر تا صد لاراول به زبان فارسی - شامل پروژه‌های عملی و پترن‌های پیشرفته',
                'price' => 450000,
                'stock' => 15,
                'image' => 'images/books/laravel.jpg',
            ],
            [
                'category_id' => $createdCategories[0]->id,
                'title' => 'طراحی الگوهای نرم‌افزاری',
                'description' => 'الگوهای طراحی (Design Patterns) با مثال‌های عملی به زبان PHP و JavaScript',
                'price' => 520000,
                'stock' => 8,
                'image' => 'images/books/design-patterns.jpg',
            ],
            [
                'category_id' => $createdCategories[0]->id,
                'title' => 'معماری تمیز',
                'description' => 'اصول طراحی و معماری نرم‌افزار برای توسعه‌دهندگان حرفه‌ای',
                'price' => 480000,
                'stock' => 12,
                'image' => 'images/books/clean-architecture.jpg',
            ],
            [
                'category_id' => $createdCategories[1]->id, // رمان
                'title' => 'صدساله‌ی تنهایی',
                'description' => 'شاهکار گابریل گارسیا مارکز - برنده جایزه نوبل ادبیات',
                'price' => 380000,
                'stock' => 20,
                'image' => 'images/books/one-hundred-years.jpg',
            ],
            [
                'category_id' => $createdCategories[3]->id, // روانشناسی
                'title' => 'روانشناسی رفتار',
                'description' => 'درک رفتار انسان و تکنیک‌های بهبود روابط اجتماعی',
                'price' => 350000,
                'stock' => 10,
                'image' => 'images/books/psychology.jpg',
            ],
            [
                'category_id' => $createdCategories[2]->id, // تاریخ
                'title' => 'تاریخ ایران باستان',
                'description' => 'بررسی جامع تمدن‌های باستانی ایران از آغاز تا اسلام',
                'price' => 420000,
                'stock' => 7,
                'image' => 'images/books/ancient-persia.jpg',
            ],
            [
                'category_id' => $createdCategories[4]->id, // کودک
                'title' => 'کوچولوی من',
                'description' => 'مجموعه داستان‌های شیرین برای کودکان ۳ تا ۶ سال',
                'price' => 280000,
                'stock' => 25,
                'image' => 'images/books/kids-story.jpg',
            ],
            [
                'category_id' => $createdCategories[5]->id, // فلسفه
                'title' => 'فلسفه برای زندگی',
                'description' => 'مقدمه‌ای ساده بر فلسفه و کاربرد آن در زندگی روزمره',
                'price' => 390000,
                'stock' => 9,
                'image' => 'images/books/philosophy.jpg',
            ],
        ];

        foreach ($products as $product) {
            Product::create([
                'category_id' => $product['category_id'],
                'title' => $product['title'],
                'description' => $product['description'],
                'price' => $product['price'],
                'stock' => $product['stock'],
                'image' => $product['image'],
                'product_type' => 'physical',
                'is_active' => true,
            ]);
        }
    }
}
