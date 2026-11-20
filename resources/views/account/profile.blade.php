@extends('layouts.bookblue')

@section('title', 'اطلاعات حساب - بوک‌بلو')

@section('content')
<div class="container py-5" dir="rtl">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-12 col-md-3 mb-4 mb-md-0">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3" style="font-weight: 700;">حساب من</h5>
                    <div class="list-group list-group-flush">
                        <a href="{{ route('account.index') }}" class="list-group-item list-group-item-action border-0">
                            <i class="bi bi-house-door me-2"></i>
                            خلاصه حساب
                        </a>
                        <a href="{{ route('account.profile') }}" class="list-group-item list-group-item-action active border-0">
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
            <!-- Update Profile Form -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4 p-md-5">
                    <h3 class="mb-4" style="font-weight: 700;">ویرایش اطلاعات</h3>
                    
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('account.profile.update') }}">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">نام و نام خانوادگی</label>
                            <input 
                                type="text" 
                                class="form-control @error('name') is-invalid @enderror" 
                                id="name" 
                                name="name" 
                                value="{{ old('name', Auth::user()->name) }}" 
                                required
                            >
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email (Read-only) -->
                        <div class="mb-4">
                            <label for="email" class="form-label">ایمیل</label>
                            <input 
                                type="email" 
                                class="form-control" 
                                id="email" 
                                value="{{ Auth::user()->email }}" 
                                readonly
                                disabled
                            >
                            <small class="text-muted">ایمیل قابل تغییر نیست.</small>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg me-1"></i>
                            ذخیره تغییرات
                        </button>
                    </form>
                </div>
            </div>

            <!-- Change Password Form -->
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 p-md-5">
                    <h3 class="mb-4" style="font-weight: 700;">تغییر رمز عبور</h3>

                    <form method="POST" action="{{ route('account.password.update') }}">
                        @csrf
                        @method('PUT')

                        <!-- Current Password -->
                        <div class="mb-3">
                            <label for="current_password" class="form-label">رمز عبور فعلی</label>
                            <input 
                                type="password" 
                                class="form-control @error('current_password') is-invalid @enderror" 
                                id="current_password" 
                                name="current_password" 
                                required
                            >
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- New Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">رمز عبور جدید</label>
                            <input 
                                type="password" 
                                class="form-control @error('password') is-invalid @enderror" 
                                id="password" 
                                name="password" 
                                required
                            >
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">حداقل 8 کاراکتر</small>
                        </div>

                        <!-- Password Confirmation -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">تکرار رمز عبور جدید</label>
                            <input 
                                type="password" 
                                class="form-control" 
                                id="password_confirmation" 
                                name="password_confirmation" 
                                required
                            >
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-shield-lock me-1"></i>
                            تغییر رمز عبور
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@endsection
