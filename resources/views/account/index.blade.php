@extends('layouts.bookblue')

@section('title', 'حساب من - بوک‌بلو')

@section('content')
<div class="container py-5" dir="rtl">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5">
                    <h2 class="mb-4" style="font-weight: 700;">حساب من</h2>
                    
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mb-4">
                        <h5 class="mb-3">اطلاعات کاربری</h5>
                        <div class="bg-light p-3 rounded">
                            <p class="mb-2"><strong>نام:</strong> {{ Auth::user()->name }}</p>
                            <p class="mb-0"><strong>ایمیل:</strong> {{ Auth::user()->email }}</p>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <form method="POST" action="{{ route('account.logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-lg w-100">
                                خروج از حساب کاربری
                            </button>
                        </form>
                    </div>

                    <div class="mt-4 text-center text-muted">
                        <small>
                            در مراحل بعدی می‌توانید پروفایل، آدرس‌ها و سفارش‌های خود را مدیریت کنید.
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
