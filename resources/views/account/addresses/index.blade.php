@extends('layouts.bookblue')

@section('title', 'نشانی‌ها - بوک‌بلو')

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
                        <h2 class="mb-0" style="font-weight: 700;">نشانی‌های من</h2>
                        <a href="{{ route('account.addresses.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-lg me-1"></i>
                            افزودن نشانی جدید
                        </a>
                    </div>
                    
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($addresses->isEmpty())
                        <div class="text-center py-5">
                            <i class="bi bi-geo-alt text-muted" style="font-size: 4rem;"></i>
                            <p class="text-muted mt-3">هنوز نشانی ثبت نکرده‌اید.</p>
                            <a href="{{ route('account.addresses.create') }}" class="btn btn-primary mt-2">
                                افزودن اولین نشانی
                            </a>
                        </div>
                    @else
                        <div class="row g-3">
                            @foreach($addresses as $address)
                                <div class="col-12">
                                    <div class="card border {{ $address->is_default ? 'border-primary' : '' }}">
                                        <div class="card-body">
                                            @if($address->is_default)
                                                <span class="badge bg-primary mb-2">نشانی پیش‌فرض</span>
                                            @endif
                                            
                                            <h5 class="card-title mb-2">{{ $address->recipient_name }}</h5>
                                            
                                            <p class="card-text mb-1">
                                                <i class="bi bi-phone me-1"></i>
                                                <strong>موبایل:</strong> {{ $address->mobile }}
                                            </p>
                                            
                                            <p class="card-text mb-1">
                                                <i class="bi bi-geo-alt me-1"></i>
                                                <strong>استان/شهر:</strong> {{ $address->province }}، {{ $address->city }}
                                            </p>
                                            
                                            <p class="card-text mb-1">
                                                <strong>نشانی:</strong> {{ $address->address }}
                                            </p>
                                            
                                            <p class="card-text mb-3">
                                                <i class="bi bi-envelope me-1"></i>
                                                <strong>کد پستی:</strong> {{ $address->postal_code }}
                                            </p>

                                            <div class="d-flex flex-wrap gap-2">
                                                <a href="{{ route('account.addresses.edit', $address) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="bi bi-pencil me-1"></i>
                                                    ویرایش
                                                </a>
                                                
                                                @if(!$address->is_default)
                                                    <form method="POST" action="{{ route('account.addresses.default', $address) }}" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-outline-success">
                                                            <i class="bi bi-check-lg me-1"></i>
                                                            انتخاب به‌عنوان پیش‌فرض
                                                        </button>
                                                    </form>
                                                @endif
                                                
                                                <form method="POST" action="{{ route('account.addresses.destroy', $address) }}" class="d-inline" onsubmit="return confirm('آیا از حذف این نشانی اطمینان دارید؟')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="bi bi-trash me-1"></i>
                                                        حذف
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@endsection
