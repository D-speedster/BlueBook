@extends('layouts.bookstore')

@section('title', 'فروشگاه آنلاین کتاب')

@section('content')
<div class="container mx-auto px-4 lg:px-8">
    
    <!-- Hero Bento Grid Section -->
    <section class="py-8 lg:py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 lg:gap-6">
            <!-- Main Hero Card (2/3 width on desktop) -->
            <div class="lg:col-span-2 bg-navy rounded-3xl p-8 lg:p-12 text-white relative overflow-hidden min-h-[400px] lg:min-h-[500px] flex flex-col justify-between">
                <div class="relative z-10">
                    <h1 class="text-3xl lg:text-5xl font-bold mb-4 leading-tight">
                        دنیای کتاب در<br>یک کلیک
                    </h1>
                    <p class="text-lg lg:text-xl text-gray-300 mb-8 max-w-md">
                        بیش از ۱۰،۰۰۰ عنوان کتاب در دسته‌بندی‌های مختلف
                    </p>
                    <a href="#products" class="inline-block px-8 py-3 bg-terracotta hover:bg-terracotta/90 rounded-full font-medium transition">
                        مشاهده همه کتاب‌ها
                    </a>
                </div>
                
                <!-- Decorative Book Image -->
                <div class="absolute left-0 bottom-0 w-1/2 opacity-20">
                    <svg class="w-full h-auto" viewBox="0 0 200 250" fill="currentColor">
                        <rect x="20" y="20" width="140" height="200" rx="8" fill="white" opacity="0.3"/>
                        <rect x="40" y="40" width="100" height="160" rx="4" fill="white" opacity="0.2"/>
                    </svg>
                </div>
            </div>
            
            <!-- Side Cards (1/3 width on desktop, stacked) -->
            <div class="flex flex-col gap-4 lg:gap-6">
                <!-- Top Small Card -->
                <div class="bg-sage rounded-3xl p-6 lg:p-8 flex-1 min-h-[180px] relative overflow-hidden">
                    <div class="relative z-10">
                        <span class="inline-block px-3 py-1 bg-white/30 rounded-full text-sm font-medium mb-3">پرفروش</span>
                        <h3 class="text-xl lg:text-2xl font-bold text-navy mb-2">
                            کتاب‌های برگزیده
                        </h3>
                        <p class="text-sm text-navy/70">
                            محبوب‌ترین انتخاب خوانندگان
                        </p>
                    </div>
                </div>
                
                <!-- Bottom Small Card -->
                <div class="bg-sand rounded-3xl p-6 lg:p-8 flex-1 min-h-[180px] relative overflow-hidden">
                    <div class="relative z-10">
                        <span class="inline-block px-3 py-1 bg-white/50 rounded-full text-sm font-medium mb-3">تخفیف ویژه</span>
                        <h3 class="text-xl lg:text-2xl font-bold text-navy mb-2">
                            تا ۵۰٪ تخفیف
                        </h3>
                        <p class="text-sm text-navy/70">
                            برای کتاب‌های منتخب
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Category Pills -->
    @if($categories->isNotEmpty())
    <section class="py-6">
        <div class="flex gap-3 overflow-x-auto scrollbar-hide pb-2">
            <a href="/" wire:navigate class="px-6 py-2.5 bg-navy text-white rounded-full font-medium whitespace-nowrap hover:bg-navy/90 transition flex-shrink-0">
                همه ({{ $products->count() }})
            </a>
            @foreach($categories as $category)
            <a href="/category/{{ $category->slug }}" wire:navigate class="px-6 py-2.5 bg-sand/50 text-navy rounded-full font-medium whitespace-nowrap hover:bg-sand transition flex-shrink-0">
                {{ $category->name }} <span class="text-sm opacity-70">({{ $category->products_count }})</span>
            </a>
            @endforeach
        </div>
    </section>
    @endif

    <!-- Book of the Week Spotlight -->
    @if($featuredProduct)
    <section class="py-8 lg:py-12">
        <h2 class="text-3xl font-bold text-navy mb-6">کتاب هفته</h2>
        <div class="bg-white rounded-3xl overflow-hidden shadow-sm">
            <div class="grid grid-cols-1 lg:grid-cols-2">
                <!-- Image Side -->
                <div class="bg-gradient-to-br from-sand to-sage p-12 flex items-center justify-center">
                    @if($featuredProduct->image)
                        <img src="{{ Storage::url($featuredProduct->image) }}" 
                             alt="{{ $featuredProduct->title }}"
                             class="max-w-xs w-full h-auto rounded-2xl shadow-2xl">
                    @else
                        <div class="w-64 h-80 bg-white/30 rounded-2xl flex items-center justify-center">
                            <svg class="w-24 h-24 text-navy/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                    @endif
                </div>
                
                <!-- Content Side -->
                <div class="p-8 lg:p-12 flex flex-col justify-center">
                    @if($featuredProduct->category)
                        <span class="inline-block px-4 py-1.5 bg-sage text-navy rounded-full text-sm font-medium mb-4 self-start">
                            {{ $featuredProduct->category->name }}
                        </span>
                    @endif
                    
                    <h3 class="text-3xl lg:text-4xl font-bold text-navy mb-4">
                        {{ $featuredProduct->title }}
                    </h3>
                    
                    @if($featuredProduct->description)
                        <p class="text-gray-600 leading-relaxed mb-6">
                            {{ $featuredProduct->description }}
                        </p>
                    @endif
                    
                    <div class="flex items-center gap-4 mb-8">
                        <span class="text-3xl font-bold text-terracotta">{{ $featuredProduct->formatted_price }}</span>
                        @if($featuredProduct->stock > 0)
                            <span class="text-sm text-green-600 font-medium">● موجود در انبار</span>
                        @else
                            <span class="text-sm text-red-600 font-medium">● ناموجود</span>
                        @endif
                    </div>
                    
                    <div class="flex gap-3">
                        <a href="/products/{{ $featuredProduct->id }}" wire:navigate class="px-8 py-3 bg-terracotta hover:bg-terracotta/90 text-white rounded-full font-medium transition">
                            مشاهده جزئیات
                        </a>
                        @if($featuredProduct->stock > 0)
                            <button class="px-8 py-3 bg-navy hover:bg-navy/90 text-white rounded-full font-medium transition">
                                افزودن به سبد
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Products Grid -->
    <section id="products" class="py-8 lg:py-12">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-3xl font-bold text-navy">تازه‌ترین کتاب‌ها</h2>
            <a href="#" class="text-terracotta hover:text-terracotta/80 font-medium flex items-center gap-2">
                مشاهده همه
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
        </div>
        
        @if($products->isEmpty())
            <div class="text-center py-20">
                <p class="text-gray-500">هیچ محصولی یافت نشد</p>
            </div>
        @else
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 lg:gap-6">
                @foreach($products as $product)
                <a href="/products/{{ $product->id }}" wire:navigate class="group">
                    <div class="bg-white rounded-2xl lg:rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300">
                        <!-- Image -->
                        <div class="aspect-[3/4] bg-gradient-to-br from-gray-50 to-gray-100 overflow-hidden">
                            @if($product->image)
                                <img src="{{ Storage::url($product->image) }}" 
                                     alt="{{ $product->title }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                     loading="lazy">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-16 h-16 lg:w-20 lg:h-20 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Content -->
                        <div class="p-4 lg:p-5">
                            @if($product->category)
                                <span class="text-xs text-gray-500 mb-2 block">{{ $product->category->name }}</span>
                            @endif
                            
                            <h3 class="font-bold text-navy text-sm lg:text-base mb-2 line-clamp-2 leading-snug">
                                {{ $product->title }}
                            </h3>
                            
                            <div class="flex items-center justify-between mt-3">
                                <span class="text-terracotta font-bold text-base lg:text-lg">
                                    {{ $product->formatted_price }}
                                </span>
                                <button class="w-8 h-8 lg:w-10 lg:h-10 rounded-full bg-terracotta/10 hover:bg-terracotta text-terracotta hover:text-white flex items-center justify-center transition group/btn">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        @endif
    </section>

    <!-- Curated Collections -->
    <section class="py-8 lg:py-12">
        <h2 class="text-3xl font-bold text-navy mb-8">مجموعه‌های پیشنهادی</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 lg:gap-6">
            <!-- Collection 1 -->
            <div class="bg-sage rounded-3xl p-8 text-center hover:shadow-lg transition cursor-pointer">
                <div class="w-32 h-32 mx-auto mb-6 bg-white/30 rounded-2xl flex items-center justify-center">
                    <svg class="w-16 h-16 text-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-navy">کتاب‌های تکنولوژی</h3>
            </div>
            
            <!-- Collection 2 -->
            <div class="bg-sand rounded-3xl p-8 text-center hover:shadow-lg transition cursor-pointer">
                <div class="w-32 h-32 mx-auto mb-6 bg-white/50 rounded-2xl flex items-center justify-center">
                    <svg class="w-16 h-16 text-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-navy">رمان و داستان</h3>
            </div>
            
            <!-- Collection 3 -->
            <div class="bg-white border-2 border-gray-100 rounded-3xl p-8 text-center hover:shadow-lg transition cursor-pointer">
                <div class="w-32 h-32 mx-auto mb-6 bg-ivory rounded-2xl flex items-center justify-center">
                    <svg class="w-16 h-16 text-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-navy">کتاب‌های کودک</h3>
            </div>
        </div>
    </section>

</div>
@endsection
