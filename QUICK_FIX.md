# حل سریع مشکل Migration

## مشکل
```
SQLSTATE[HY000]: General error: 1 no such table: addresses
```

## راه‌حل

### گزینه ۱: اجرای دستی Migration

در terminal پروژه، دستور زیر را اجرا کنید:

```bash
php artisan migrate
```

یا اگر PHP در PATH نیست:

```bash
# Windows - Laragon
C:\laragon\bin\php\php-8.2\php.exe artisan migrate

# Windows - XAMPP
C:\xampp\php\php.exe artisan migrate

# Windows - مسیر دلخواه
[مسیر PHP]\php.exe artisan migrate
```

---

### گزینه ۲: اجرای فایل Batch

دوبار کلیک روی فایل:
```
RUN_MIGRATION.bat
```

این فایل به‌طور خودکار PHP را پیدا کرده و migration را اجرا می‌کند.

---

### گزینه ۳: اجرای در Laravel Herd / Valet

اگر از Laravel Herd یا Valet استفاده می‌کنید:

```bash
herd php artisan migrate
```

---

### گزینه ۴: اجرای Manual SQL (آخرین راه‌حل)

اگر هیچ‌کدام کار نکرد، SQL زیر را مستقیماً در database اجرا کنید:

```sql
CREATE TABLE IF NOT EXISTS "addresses" (
    "id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    "user_id" INTEGER NOT NULL,
    "recipient_name" VARCHAR NOT NULL,
    "mobile" VARCHAR NOT NULL,
    "province" VARCHAR NOT NULL,
    "city" VARCHAR NOT NULL,
    "address" TEXT NOT NULL,
    "postal_code" VARCHAR NOT NULL,
    "is_default" TINYINT(1) DEFAULT 0 NOT NULL,
    "created_at" DATETIME,
    "updated_at" DATETIME,
    FOREIGN KEY("user_id") REFERENCES "users"("id") ON DELETE CASCADE
);

CREATE INDEX "addresses_user_id_is_default_index" ON "addresses" ("user_id", "is_default");
```

**مراحل:**
1. باز کردن `database/database.sqlite` با SQLite Browser یا DB Browser
2. رفتن به تب "Execute SQL"
3. Paste کردن SQL بالا
4. کلیک روی "Execute"

---

## بررسی موفقیت Migration

بعد از اجرای migration، دستور زیر را اجرا کنید:

```bash
php artisan migrate:status
```

خروجی باید شامل این خط باشد:
```
✓ 2026_11_21_120000_create_addresses_table .................... 0.02s DONE
```

---

## تست سریع

بعد از migration، مراجعه کنید به:
```
http://localhost:8000/account
```

شمارنده نشانی‌ها باید بدون خطا نمایش داده شود (مقدار اولیه: 0).

---

## اگر هنوز مشکل دارید

دستورات زیر را به ترتیب اجرا کنید:

```bash
# پاک کردن cache
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# اجرای دوباره migration
php artisan migrate:fresh

# اگر داده‌های قبلی دارید و نمی‌خواهید از دست بروند:
php artisan migrate --force
```

---

## یادداشت مهم

اگر قبلاً داده‌های کاربر دارید، `migrate:fresh` همه را پاک می‌کند. در این صورت فقط از `migrate` استفاده کنید.
