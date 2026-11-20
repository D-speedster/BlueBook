<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'بوک‌بلو - فروشگاه کتاب')</title>
    
    <!-- Bootstrap RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    
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
    </style>
    
    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('css/bookblue.css') }}">
    
    @livewireStyles
</head>
<body>
    <!-- Header -->
    <header class="bookblue-header">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <span class="brand-name">بوک<span class="brand-highlight">بلو</span></span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/">همه کتاب‌ها</a>
                        </li>
                        @php
                            $headerCategories = \App\Models\Category::where('is_active', true)->get();
                        @endphp
                        @foreach($headerCategories as $cat)
                            <li class="nav-item">
                                <a class="nav-link" href="/category/{{ $cat->slug }}">{{ $cat->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    حساب من
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="accountDropdown">
                                    <li><a class="dropdown-item" href="{{ route('account.index') }}">داشبورد</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="{{ route('account.logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item">خروج</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">ورود</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn-register" href="{{ route('register') }}">ثبت‌نام</a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bookblue-footer">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="brand-name mb-3">بوک<span class="brand-highlight">بلو</span></h5>
                    <p class="text-muted">فروشگاه آنلاین کتاب با تمرکز بر کتاب‌های تخصصی برنامه‌نویسی و فناوری</p>
                </div>
                <div class="col-md-3">
                    <h6 class="mb-3">دسترسی سریع</h6>
                    <ul class="list-unstyled">
                        <li><a href="/" class="text-muted text-decoration-none">صفحه اصلی</a></li>
                        @foreach($headerCategories as $cat)
                            <li><a href="/category/{{ $cat->slug }}" class="text-muted text-decoration-none">{{ $cat->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-3">
                    <h6 class="mb-3">درباره بوک‌بلو</h6>
                    <p class="text-muted small">فروشگاه تخصصی کتاب با هدف ارائه منابع باکیفیت به علاقه‌مندان برنامه‌نویسی و توسعه نرم‌افزار</p>
                </div>
            </div>
            <hr class="my-4">
            <div class="text-center text-muted small">
                <p class="mb-0">© {{ date('Y') }} بوک‌بلو - تمامی حقوق محفوظ است</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @livewireScripts
</body>
</html>
