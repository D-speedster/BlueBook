@extends('layouts.bookblue')

@section('title', 'حساب من - بوک‌بلو')

@section('content')
<div class="container py-5" dir="rtl">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-12 col-md-3 mb-4 mb-md-0">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3" style="font-weight: 700;">حساب من</h5>
                    <div class="list-group list-group-flush">
                        <a href="{{ route('account.index') }}" class="list-group-item list-group-item-action active border-0">
                            <i class="bi bi-house-door me-2"></i>
                            خلاصه حساب
                        </a>
                        <a href="{{ route('account.profile') }}" class="list-group-item list-group-item-action border-0">
                            <i class="bi bi-person me-2"></i>
                            اطلاعات حساب
                        </a>
                        <a href="{{ route('account.addresses') }}" class="list-group-item list-group-item-action border-0">
                            <i class="bi bi-geo-alt me-2"></i>
                            نشانی‌ها
                        </a>
                        <form method="POST" action="{{ route('account.logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="list-group-item list-group-item-action border-0 text-danger w-100 text-end">
                                <i class="bi bi-box-arrow-right me-2"></i>
                                خروج
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-12 col-md-9">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 p-md-5">
                    <h2 class="mb-4" style="font-weight: 700;">خلاصه حساب</h2>
                    
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Welcome Message -->
                    <div class="mb-4">
                        <p class="lead">
                            سلام <strong>{{ Auth::user()->name }}</strong>، به حساب کاربری خود خوش آمدید.
                        </p>
                    </div>

                    <!-- Quick Stats -->
                    <div class="row g-3 mb-4">
                        <div class="col-12 col-sm-6">
                            <div class="card bg-light border-0 h-100">
                                <div class="card-body">
                                    <h6 class="text-muted mb-2">نشانی‌های ثبت‌شده</h6>
                                    <h3 class="mb-0">{{ $addressCount }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="card bg-light border-0 h-100">
                                <div class="card-body">
                                    <h6 class="text-muted mb-2">سفارش‌ها</h6>
                                    <h3 class="mb-0">0</h3>
                                    <small class="text-muted">به‌زودی...</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="mb-4">
                        <h5 class="mb-3">دسترسی سریع</h5>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('account.profile') }}" class="btn btn-outline-primary">
                                <i class="bi bi-person me-1"></i>
                                ویرایش پروفایل
                            </a>
                            <a href="{{ route('account.addresses') }}" class="btn btn-outline-primary">
                                <i class="bi bi-geo-alt me-1"></i>
                                مدیریت نشانی‌ها
                            </a>
                        </div>
                    </div>

                    <!-- Account Info -->
                    <div class="bg-light p-3 rounded">
                        <h6 class="mb-3">اطلاعات کاربری</h6>
                        <p class="mb-2"><strong>نام:</strong> {{ Auth::user()->name }}</p>
                        <p class="mb-0"><strong>ایمیل:</strong> {{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@endsection
