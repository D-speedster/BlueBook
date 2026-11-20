# حل مشکل CSS در صفحه اصلی

## علت مشکل

صفحه اصلی (`/`) از Tailwind CSS استفاده می‌کند که باید با Vite کامپایل شود.
صفحات پنل مشتری (`/account`) از Bootstrap استفاده می‌کنند که از CDN لود می‌شوند.

---

## راه‌حل سریع

### گزینه ۱: Build کردن Assets (توصیه می‌شود)

دوبار کلیک روی فایل:
```
build-assets.bat
```

یا در terminal:
```bash
npm install
npm run build
```

---

### گزینه ۲: اجرای مجدد با اسکریپت start

فایل `start.bat` یا `start.ps1` به‌طور خودکار assets را build می‌کنند:
```
start.bat
```

---

### گزینه ۳: استفاده از Vite Dev Server (برای توسعه)

اگر دارید روی پروژه کار می‌کنید، در یک terminal جدا:
```bash
npm run dev
```

و در terminal دیگر:
```bash
php artisan serve
```

---

## بررسی موفقیت Build

بعد از build، فایل‌های زیر باید وجود داشته باشند:

```
public/build/manifest.json
public/build/assets/app-[hash].css
public/build/assets/app-[hash].js
```

---

## تست

1. Build کردن assets
2. اجرای سرور: `php artisan serve`
3. باز کردن: http://localhost:8000
4. بررسی: CSS‌ها باید درست نمایش داده شوند

---

## اگر هنوز مشکل دارید

### پاک کردن cache:
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

### پاک کردن node_modules و دوباره نصب:
```bash
rmdir /s /q node_modules
rmdir /s /q public\build
npm install
npm run build
```

### Hard Refresh در مرورگر:
```
Ctrl + Shift + R  (Chrome/Firefox)
Ctrl + F5         (Edge)
```

---

## نکته مهم

اگر تغییری در فایل‌های CSS یا JS دادید، باید دوباره build کنید:
```bash
npm run build
```

یا برای توسعه مداوم:
```bash
npm run dev
```
