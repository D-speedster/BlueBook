@extends('layouts.bookblue')

@section('title', 'ورود - بوک‌بلو')

@section('content')
<div class="container py-5" dir="rtl">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-5">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5">
                    <h2 class="text-center mb-4" style="font-weight: 700;">ورود به حساب کاربری</h2>
                    
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" dir="rtl" lang="fa">
                        @csrf

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
                                autofocus
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
                                placeholder="رمز عبور خود را وارد کنید"
                            >
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember" value="1">
                            <label class="form-check-label" for="remember">
                                مرا به خاطر بسپار
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid gap-2 mb-3">
                            <button type="submit" class="btn btn-primary btn-lg">
                                ورود
                            </button>
                        </div>

                        <!-- Register Link -->
                        <div class="text-center">
                            <p class="mb-0">
                                حساب کاربری ندارید؟ 
                                <a href="{{ route('register') }}" class="text-decoration-none">ثبت‌نام کنید</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
