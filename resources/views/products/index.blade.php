@extends('layouts.app')

@section('title', isset($category) ? $category->name . ' - نشر ماهریس' : 'نشر ماهریس')

@section('content')
<div class="container mx-auto px-4 py-4">
        <!-- Categories Menu -->
        @php
            $categories = \App\Models\Category::where('is_active', true)->withCount('products')->get();
        @endphp
        
        @if($categories->isNotEmpty())
            <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
                <h2 class="text-lg font-semibold mb-3 text-gray-700">دسته‌بندی‌ها</h2>
                <div class="flex flex-wrap gap-2">
                    <a href="/" wire:navigate class="px-4 py-2 rounded-full {{ !isset($category) ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} transition">
                        همه ({{ \App\Models\Product::where('is_active', true)->count() }})
                    </a>
                    @foreach($categories as $cat)
                        <a href="/category/{{ $cat->slug }}" wire:navigate
                           class="px-4 py-2 rounded-full {{ isset($category) && $category->id === $cat->id ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} transition">
                            {{ $cat->name }} ({{ $cat->products_count }})
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Page Title -->
        <h2 class="text-2xl font-bold text-gray-800 mb-6">
            @if(isset($category))
                {{ $category->name }}
                @if($category->description)
                    <p class="text-sm text-gray-600 font-normal mt-2">{{ $category->description }}</p>
                @endif
            @else
                همه محصولات
            @endif
        </h2>
        
        @if($products->isEmpty())
            <div class="text-center text-gray-600 py-12 bg-white rounded-lg shadow">
                <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                </svg>
                <p class="text-xl">هیچ محصولی یافت نشد</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($products as $product)
                    <a href="/products/{{ $product->id }}" wire:navigate class="block bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        @if($product->image)
                            <img src="{{ Storage::url($product->image) }}" alt="{{ $product->title }}" class="w-full h-64 object-cover">
                        @else
                            <div class="w-full h-64 bg-gradient-to-br from-blue-50 to-blue-100 flex items-center justify-center">
                                <svg class="w-24 h-24 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                        
                        <div class="p-6">
                            @if($product->category)
                                <span class="inline-block px-3 py-1 text-xs font-semibold text-blue-600 bg-blue-100 rounded-full mb-2">
                                    {{ $product->category->name }}
                                </span>
                            @endif
                            
                            <h2 class="text-2xl font-bold text-gray-800 mb-3">{{ $product->title }}</h2>
                            
                            @if($product->description)
                                <p class="text-gray-600 mb-4">{{ $product->description }}</p>
                            @endif
                            
                            <div class="mt-4 border-t pt-4">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <span class="text-sm text-gray-500">قیمت:</span>
                                        <div class="text-2xl font-bold text-blue-600">
                                            {{ $product->formatted_price }}
                                        </div>
                                    </div>
                                    <div class="text-left">
                                        <span class="text-sm text-gray-500">موجودی:</span>
                                        <div class="font-semibold {{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                                            @if($product->stock > 0)
                                                {{ number_format($product->stock) }} عدد
                                            @else
                                                ناموجود
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $products->links() }}
            </div>
        @endif
    </div>
@endsection
