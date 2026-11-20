@extends('layouts.bookstore')

@section('title', $product->title . ' - فروشگاه کتاب')

@section('content')
<div class="container mx-auto px-4 lg:px-8 py-8">
    <!-- Breadcrumb -->
    <nav class="mb-6 text-sm" aria-label="breadcrumb">
        <ol class="flex items-center gap-2 text-gray-600">
            <li><a href="/" class="hover:text-navy transition">خانه</a></li>
            <li><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/></svg></li>
            @if($product->category)
                <li><a href="/category/{{ $product->category->slug }}" class="hover:text-navy transition">{{ $product->category->name }}</a></li>
                <li><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/></svg></li>
            @endif
            <li class="text-navy font-medium">{{ $product->title }}</li>
        </ol>
    </nav>

    <!-- Product Details -->
    <div class="bg-white rounded-3xl overflow-hidden shadow-sm">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
            <!-- Image Column -->
            <div class="p-8 lg:p-12 bg-gradient-to-br from-ivory to-sage flex items-center justify-center">
                @if($product->cover_image)
                    <img src="{{ Storage::url($product->cover_image) }}" 
                         alt="{{ $product->title }}"
                         class="max-w-sm w-full rounded-2xl shadow-2xl">
                @elseif($product->image)
                    <img src="{{ Storage::url($product->image) }}" 
                         alt="{{ $product->title }}"
                         class="max-w-sm w-full rounded-2xl shadow-2xl">
                @else
                    <div class="w-80 h-96 bg-white/30 rounded-2xl flex items-center justify-center">
                        <svg class="w-32 h-32 text-navy/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                @endif
            </div>

            <!-- Content Column -->
            <div class="p-8 lg:p-12 flex flex-col justify-center">
                @if($product->category)
                    <span class="inline-block px-4 py-1.5 bg-sage text-navy rounded-full text-sm font-medium mb-4 self-start">
                        {{ $product->category->name }}
                    </span>
                @endif

                <h1 class="text-3xl lg:text-4xl font-bold text-navy mb-4">
                    {{ $product->title }}
                </h1>

                @if($product->authors && is_array($product->authors) && count($product->authors) > 0)
                    <div class="mb-4">
                        <span class="text-gray-600">نویسنده: </span>
                        <span class="font-medium text-navy">{{ implode('، ', $product->authors) }}</span>
                    </div>
                @endif

                @if($product->summary)
                    <p class="text-gray-600 leading-relaxed mb-4 text-lg">
                        {{ $product->summary }}
                    </p>
                @endif

                @if($product->description)
                    <p class="text-gray-600 leading-relaxed mb-6">
                        {{ $product->description }}
                    </p>
                @endif

                <!-- نسخه‌های کتاب -->
                <div class="space-y-4 mb-6">
                    <h3 class="text-xl font-bold text-navy mb-4">نسخه‌های موجود</h3>
                    
                    @foreach($product->publishedVariants as $variant)
                    <div class="bg-ivory rounded-2xl p-6 border-2 border-transparent hover:border-terracotta transition">
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <h4 class="text-lg font-bold text-navy">{{ $variant->name }}</h4>
                                @if($variant->publisher)
                                    <p class="text-sm text-gray-600">ناشر: {{ $variant->publisher->name }}</p>
                                @endif
                            </div>
                            <div class="text-left">
                                <div class="text-2xl font-bold text-terracotta">{{ $variant->formatted_price }}</div>
                                @if($variant->stock > 0)
                                    <span class="text-sm text-green-600 font-medium">● موجود</span>
                                @else
                                    <span class="text-sm text-red-600 font-medium">● ناموجود</span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 text-sm text-gray-600 mb-4">
                            @if($variant->translator)
                                <div><span class="font-medium">مترجم:</span> {{ $variant->translator }}</div>
                            @endif
                            @if($variant->size)
                                <div><span class="font-medium">قطع:</span> {{ $variant->size }}</div>
                            @endif
                            @if($variant->cover_type)
                                <div><span class="font-medium">جلد:</span> {{ $variant->cover_type }}</div>
                            @endif
                            @if($variant->pages)
                                <div><span class="font-medium">صفحات:</span> {{ number_format($variant->pages) }}</div>
                            @endif
                            @if($variant->edition)
                                <div><span class="font-medium">چاپ:</span> {{ $variant->edition }}</div>
                            @endif
                            @if($variant->publish_year)
                                <div><span class="font-medium">سال:</span> {{ $variant->publish_year }}</div>
                            @endif
                            @if($variant->isbn)
                                <div class="col-span-2"><span class="font-medium">شابک:</span> {{ $variant->isbn }}</div>
                            @endif
                        </div>
                        
                        @if($variant->stock > 0)
                            <button class="w-full px-6 py-3 bg-terracotta hover:bg-terracotta/90 text-white rounded-full font-medium transition">
                                افزودن به سبد خرید
                            </button>
                        @endif
                    </div>
                    @endforeach
                </div>

                <!-- Back Button -->
                <a href="/" class="block text-center px-8 py-3 bg-navy hover:bg-navy/90 text-white rounded-full font-medium transition">
                    بازگشت به صفحه اصلی
                </a>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if($product->category)
        @php
            $relatedProducts = \App\Models\Product::where('category_id', $product->category_id)
                ->where('id', '!=', $product->id)
                ->where('is_active', true)
                ->take(4)
                ->get();
        @endphp

        @if($relatedProducts->isNotEmpty())
            <section class="mt-16">
                <h2 class="text-2xl font-bold text-navy mb-6">کتاب‌های مرتبط</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 lg:gap-6">
                    @foreach($relatedProducts as $related)
                    <a href="/products/{{ $related->id }}" class="group">
                        <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition">
                            <div class="aspect-[3/4] bg-gradient-to-br from-gray-50 to-gray-100">
                                @if($related->cover_image)
                                    <img src="{{ Storage::url($related->cover_image) }}" 
                                         alt="{{ $related->title }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                @elseif($related->image)
                                    <img src="{{ Storage::url($related->image) }}" 
                                         alt="{{ $related->title }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="p-4">
                                <h3 class="font-bold text-navy text-sm line-clamp-2 mb-2">{{ $related->title }}</h3>
                                @if($related->min_price)
                                    <span class="text-terracotta font-bold">از {{ number_format($related->min_price) }} تومان</span>
                                @endif
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </section>
        @endif
    @endif
</div>
@endsection
