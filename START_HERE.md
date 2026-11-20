# 🚀 اجرای سریع پروژه BlueBook

## روش ۱: اجرای خودکار (توصیه می‌شود)

### Windows - دوبار کلیک روی:
```
start.bat
```

### PowerShell:
```powershell
.\start.ps1
```

---

## روش ۲: اجرای دستی

```bash
# 1. اجرای migration
php artisan migrate

# 2. اجرای سرور
php artisan serve
```

---

## 🌐 دسترسی به سایت

بعد از اجرا، این آدرس‌ها را باز کنید:

| صفحه | آدرس | توضیح |
|------|------|-------|
| **ثبت‌نام** | http://localhost:8000/register | ساخت حساب جدید |
| **ورود** | http://localhost:8000/login | ورود به حساب |
| **پنل مشتری** | http://localhost:8000/account | داشبورد مشتری |
| **پنل ادمین** | http://localhost:8000/admin | Filament (فقط admin) |
| **صفحه اصلی** | http://localhost:8000 | فروشگاه |

---

## 👤 حساب تستی برای شروع

**برای تست، یک حساب بسازید:**
- نام: تست کاربر
- ایمیل: test@example.com
- رمز: password123

---

## 📋 چک‌لیست تست

بعد از اجرا:
- [ ] ثبت‌نام یک حساب
- [ ] ورود به حساب
- [ ] رفتن به `/account`
- [ ] کلیک روی "اطلاعات حساب"
- [ ] کلیک روی "نشانی‌ها"
- [ ] افزودن یک نشانی
- [ ] خروج و ورود مجدد

---

## ❓ مشکل دارید؟

### خطای Migration:
```bash
php artisan migrate:fresh
```

### خطای Cache:
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

### PHP پیدا نمی‌شود:
در terminal دستور زیر را اجرا کنید:
```bash
where php
```

اگر خروجی نداد، PHP را به PATH اضافه کنید یا مسیر کامل را استفاده کنید:
```bash
C:\laragon\bin\php\php-8.2\php.exe artisan serve
```

---

## 📚 مستندات کامل

- `TESTING_GUIDE.md` - راهنمای تست جامع
- `IMPLEMENTATION_REPORT.md` - گزارش فنی کامل
- `QUICK_FIX.md` - حل مشکلات رایج

---

## 🛑 توقف سرور

در terminal که سرور اجراست:
```
Ctrl + C
```

---

**نکته:** اگر port 8000 اشغال است، سرور روی port دیگری اجرا می‌شود (مثلاً 8001)
