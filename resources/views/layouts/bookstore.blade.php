<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'فروشگاه کتاب')</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'ivory': '#FAF8F5',
                        'navy': '#162A3E',
                        'terracotta': '#C86D51',
                        'sage': '#D3DFD4',
                        'sand': '#E9DEC8',
                    },
                    fontFamily: {
                        'vazir': ['Vazirmatn', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    
    <!-- Vazirmatn Font -->
    <style>
        @font-face {
            font-family: 'Vazirmatn';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: url('/fonts/Vazirmatn-Regular.woff2') format('woff2');
        }
        @font-face {
            font-family: 'Vazirmatn';
            font-style: normal;
            font-weight: 500;
            font-display: swap;
            src: url('/fonts/Vazirmatn-Medium.woff2') format('woff2');
        }
        @font-face {
            font-family: 'Vazirmatn';
            font-style: normal;
            font-weight: 700;
            font-display: swap;
            src: url('/fonts/Vazirmatn-Bold.woff2') format('woff2');
        }
        
        * {
            font-family: 'Vazirmatn', -apple-system, BlinkMacSystemFont, sans-serif;
        }
        
        /* Custom scrollbar for category pills */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        
        /* Smooth transitions */
        @media (prefers-reduced-motion: no-preference) {
            * {
                scroll-behavior: smooth;
            }
        }
    </style>
    
    @livewireStyles
</head>
<body class="bg-ivory font-vazir antialiased">
    <!-- Header -->
    <header class="sticky top-0 z-50 bg-ivory/95 backdrop-blur-sm border-b border-gray-200">
        <div class="container mx-auto px-4 lg:px-8">
            <!-- Top Row: Logo, Search, Icons -->
            <div class="flex items-center justify-between gap-6 py-4">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="/" wire:navigate class="text-2xl font-bold text-navy">
                        کتاب<span class="text-terracotta">فروش</span>
                    </a>
                </div>
                
                <!-- Search Box (Hidden on mobile, shown on md+) -->
                <div class="hidden md:flex flex-1 max-w-2xl">
                    <div class="relative w-full">
                        <input 
                            type="text" 
                            placeholder="جستجوی کتاب، نویسنده یا ناشر..."
                            class="w-full px-6 py-3 pr-12 rounded-full bg-white border border-gray-200 focus:outline-none focus:ring-2 focus:ring-terracotta/20 focus:border-terracotta transition"
                        >
                        <svg class="absolute right-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </div>
                
                <!-- Icons -->
                <div class="flex items-center gap-3">
                    <!-- Account -->
                    <button class="p-2 hover:bg-gray-100 rounded-full transition">
                        <svg class="w-6 h-6 text-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </button>
                    
                    <!-- Cart with Badge -->
                    <button class="relative p-2 hover:bg-gray-100 rounded-full transition">
                        <svg class="w-6 h-6 text-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span class="absolute -top-1 -left-1 bg-terracotta text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">3</span>
                    </button>
                </div>
            </div>
            
            <!-- Bottom Row: Navigation Menu -->
            <nav class="border-t border-gray-100 py-3">
                <ul class="flex items-center gap-6 overflow-x-auto scrollbar-hide text-sm">
                    <li><a href="/" wire:navigate class="text-navy hover:text-terracotta font-medium transition whitespace-nowrap">خانه</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-navy font-medium transition whitespace-nowrap">پرفروش‌ها</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-navy font-medium transition whitespace-nowrap">تازه‌ها</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-navy font-medium transition whitespace-nowrap">پیشنهاد ویژه</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-navy font-medium transition whitespace-nowrap">درباره ما</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-navy font-medium transition whitespace-nowrap">تماس با ما</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="mt-20 mb-8">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="bg-navy rounded-3xl p-8 lg:p-12 text-white">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
                    <!-- Column 1: About -->
                    <div>
                        <h3 class="text-xl font-bold mb-4">درباره فروشگاه</h3>
                        <p class="text-gray-300 text-sm leading-relaxed">
                            فروشگاه آنلاین کتاب با بیش از ۱۰،۰۰۰ عنوان کتاب در زمینه‌های مختلف
                        </p>
                    </div>
                    
                    <!-- Column 2: Quick Links -->
                    <div>
                        <h3 class="text-xl font-bold mb-4">دسترسی سریع</h3>
                        <ul class="space-y-2 text-sm">
                            <li><a href="/" wire:navigate class="text-gray-300 hover:text-white transition">صفحه اصلی</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition">درباره ما</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition">تماس با ما</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition">قوانین و مقررات</a></li>
                        </ul>
                    </div>
                    
                    <!-- Column 3: Customer Service -->
                    <div>
                        <h3 class="text-xl font-bold mb-4">خدمات مشتریان</h3>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#" class="text-gray-300 hover:text-white transition">پیگیری سفارش</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition">رویه بازگشت کالا</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition">سوالات متداول</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition">راهنمای خرید</a></li>
                        </ul>
                    </div>
                    
                    <!-- Column 4: Newsletter -->
                    <div>
                        <h3 class="text-xl font-bold mb-4">عضویت در خبرنامه</h3>
                        <p class="text-gray-300 text-sm mb-4">از آخرین تخفیف‌ها و کتاب‌های جدید باخبر شوید</p>
                        <div class="flex gap-2">
                            <input 
                                type="email" 
                                placeholder="ایمیل شما"
                                class="flex-1 px-4 py-2 rounded-full bg-white text-navy text-sm focus:outline-none"
                            >
                            <button class="px-6 py-2 bg-terracotta hover:bg-terracotta/90 rounded-full text-sm font-medium transition">
                                عضویت
                            </button>
                        </div>
                        
                        <!-- Social Icons -->
                        <div class="flex gap-3 mt-6">
                            <a href="#" class="w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            </a>
                            <a href="#" class="w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                            </a>
                            <a href="#" class="w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Copyright -->
                <div class="border-t border-white/10 pt-6 text-center text-sm text-gray-400">
                    <p>© {{ date('Y') }} تمامی حقوق محفوظ است • فروشگاه آنلاین کتاب</p>
                </div>
            </div>
        </div>
    </footer>

    @livewireScripts
</body>
</html>
