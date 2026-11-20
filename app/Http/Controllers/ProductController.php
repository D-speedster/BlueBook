<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        // محصولات برای گرید اصلی با pagination
        $products = Product::with('category')
            ->where('is_active', true)
            ->latest()
            ->paginate(12);

        // محصول ویژه برای بخش "کتاب هفته"
        $featuredProduct = Product::with('category')
            ->where('is_active', true)
            ->latest()
            ->first();

        // دسته‌بندی‌های فعال برای نوار کپسولی
        $categories = Category::where('is_active', true)
            ->withCount('products')
            ->get();

        return view('home', compact('products', 'featuredProduct', 'categories'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $products = Product::with('category')
            ->where('category_id', $category->id)
            ->where('is_active', true)
            ->latest()
            ->paginate(12);

        return view('products.index', compact('products', 'category'));
    }

    public function show(Product $product)
    {
        // Only show active products
        abort_if(!$product->is_active, 404);

        // Eager load relationships
        $product->load([
            'category',
            'publishedVariants.publisher'
        ]);

        // اگر هیچ نسخه منتشر شده‌ای ندارد، 404
        if ($product->publishedVariants->isEmpty()) {
            abort(404);
        }

        return view('products.show', compact('product'));
    }
}
