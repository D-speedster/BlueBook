<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'نشر ماهریس')</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
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
            font-family: 'Vazirmatn', Tahoma, Arial, sans-serif;
        }
    </style>
    
    @livewireStyles
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm mb-8">
        <div class="container mx-auto px-4 py-4">
            <h1 class="text-3xl font-bold text-gray-800">
                <a href="/" wire:navigate class="hover:text-blue-600">نشر ماهریس</a>
            </h1>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="mt-12 bg-white border-t border-gray-200">
        <div class="container mx-auto px-4 py-6 text-center text-gray-600">
            <p>نشر ماهریس - ساخته شده با Laravel {{ app()->version() }}</p>
        </div>
    </footer>

    @livewireScripts
</body>
</html>
