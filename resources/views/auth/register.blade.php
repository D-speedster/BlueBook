@extends('layouts.bookblue')

@section('title', 'ثبت‌نام - بوک‌بلو')

@section('content')
<div class="container py-5" dir="rtl">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-5">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5">
                    <h2 class="text-center mb-4" style="font-weight: 700;">ثبت‌نام در بوک‌بلو</h2>
                    
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}" dir="rtl" lang="fa">
                        @csrf

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">نام و نام خانوادگی</label>
                            <input 
                                type="text" 
                                class="form-control @error('name') is-invalid @enderror" 
                                id="name" 
                                name="name" 
                                value="{{ old('name') }}" 
                                required 
                                autofocus
                                placeholder="نام کامل خود را وارد کنید"
                            >
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">ایمیل</label>
                            <input 
                                type="email" 
                                class="form-control @error('email') is-invalid @enderror" 
                                id="email" 
                                name="email" 
                                value="{{ old('email') }}" 
                                required
                                placeholder="example@email.com"
                            >
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">رمز عبور</label>
                            <input 
                                type="password" 
                                class="form-control @error('password') is-invalid @enderror" 
                                id="password" 
                                name="password" 
                                required
                                placeholder="حداقل 8 کاراکتر"
                            >
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password Confirmation -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">تکرار رمز عبور</label>
                            <input 
                                type="password" 
                                class="form-control @error('password_confirmation') is-invalid @enderror" 
                                id="password_confirmation" 
                                name="password_confirmation" 
                                required
                                placeholder="رمز عبور را مجدداً وارد کنید"
                            >
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid gap-2 mb-3">
                            <button type="submit" class="btn btn-primary btn-lg">
                                ثبت‌نام
                            </button>
                        </div>

                        <!-- Login Link -->
                        <div class="text-center">
                            <p class="mb-0">
                                قبلاً ثبت‌نام کرده‌اید؟ 
                                <a href="{{ route('login') }}" class="text-decoration-none">وارد شوید</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
