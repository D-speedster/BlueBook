@extends('layouts.bookblue')

@section('title', 'افزودن نشانی - بوک‌بلو')

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
                        <a href="{{ route('account.profile') }}" class="list-group-item list-group-item-action border-0">
                            <i class="bi bi-person me-2"></i>
                            اطلاعات حساب
                        </a>
                        <a href="{{ route('account.addresses') }}" class="list-group-item list-group-item-action active border-0">
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
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="mb-0" style="font-weight: 700;">افزودن نشانی جدید</h2>
                        <a href="{{ route('account.addresses') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-right me-1"></i>
                            بازگشت
                        </a>
                    </div>

                    <form method="POST" action="{{ route('account.addresses.store') }}">
                        @csrf

                        <div class="row">
                            <!-- Recipient Name -->
                            <div class="col-12 col-md-6 mb-3">
                                <label for="recipient_name" class="form-label">نام گیرنده <span class="text-danger">*</span></label>
                                <input 
                                    type="text" 
                                    class="form-control @error('recipient_name') is-invalid @enderror" 
                                    id="recipient_name" 
                                    name="recipient_name" 
                                    value="{{ old('recipient_name') }}" 
                                    required
                                >
                                @error('recipient_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Mobile -->
                            <div class="col-12 col-md-6 mb-3">
                                <label for="mobile" class="form-label">شماره موبایل <span class="text-danger">*</span></label>
                                <input 
                                    type="text" 
                                    class="form-control @error('mobile') is-invalid @enderror" 
                                    id="mobile" 
                                    name="mobile" 
                                    value="{{ old('mobile') }}" 
                                    placeholder="09123456789"
                                    maxlength="11"
                                    required
                                >
                                @error('mobile')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Province -->
                            <div class="col-12 col-md-6 mb-3">
                                <label for="province" class="form-label">استان <span class="text-danger">*</span></label>
                                <input 
                                    type="text" 
                                    class="form-control @error('province') is-invalid @enderror" 
                                    id="province" 
                                    name="province" 
                                    value="{{ old('province') }}" 
                                    required
                                >
                                @error('province')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- City -->
                            <div class="col-12 col-md-6 mb-3">
                                <label for="city" class="form-label">شهر <span class="text-danger">*</span></label>
                                <input 
                                    type="text" 
                                    class="form-control @error('city') is-invalid @enderror" 
                                    id="city" 
                                    name="city" 
                                    value="{{ old('city') }}" 
                                    required
                                >
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Address -->
                            <div class="col-12 mb-3">
                                <label for="address" class="form-label">نشانی کامل <span class="text-danger">*</span></label>
                                <textarea 
                                    class="form-control @error('address') is-invalid @enderror" 
                                    id="address" 
                                    name="address" 
                                    rows="3" 
                                    required
                                >{{ old('address') }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Postal Code -->
                            <div class="col-12 col-md-6 mb-3">
                                <label for="postal_code" class="form-label">کد پستی <span class="text-danger">*</span></label>
                                <input 
                                    type="text" 
                                    class="form-control @error('postal_code') is-invalid @enderror" 
                                    id="postal_code" 
                                    name="postal_code" 
                                    value="{{ old('postal_code') }}" 
                                    placeholder="1234567890"
                                    maxlength="10"
                                    required
                                >
                                @error('postal_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">10 رقم بدون خط تیره</small>
                            </div>

                            <!-- Is Default -->
                            <div class="col-12 mb-4">
                                <div class="form-check">
                                    <input 
                                        class="form-check-input" 
                                        type="checkbox" 
                                        id="is_default" 
                                        name="is_default"
                                        value="1"
                                        {{ old('is_default') ? 'checked' : '' }}
                                    >
                                    <label class="form-check-label" for="is_default">
                                        انتخاب به‌عنوان نشانی پیش‌فرض
                                    </label>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg me-1"></i>
                            ذخیره نشانی
                        </button>
                        <a href="{{ route('account.addresses') }}" class="btn btn-outline-secondary me-2">
                            انصراف
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@endsection
