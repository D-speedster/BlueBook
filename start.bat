@echo off
chcp 65001 >nul
title BlueBook - Quick Start

echo.
echo ╔════════════════════════════════════════════════════╗
echo ║         BlueBook - اجرای سریع پروژه                ║
echo ╚════════════════════════════════════════════════════╝
echo.

REM Find PHP
set PHP_FOUND=0
set PHP_PATH=

where php >nul 2>&1
if %ERRORLEVEL% EQU 0 (
    set PHP_PATH=php
    set PHP_FOUND=1
    echo [✓] PHP found in PATH
    goto :php_found
)

if exist "C:\laragon\bin\php\php-8.3\php.exe" (
    set PHP_PATH=C:\laragon\bin\php\php-8.3\php.exe
    set PHP_FOUND=1
    echo [✓] PHP found: Laragon 8.3
    goto :php_found
)

if exist "C:\laragon\bin\php\php-8.2\php.exe" (
    set PHP_PATH=C:\laragon\bin\php\php-8.2\php.exe
    set PHP_FOUND=1
    echo [✓] PHP found: Laragon 8.2
    goto :php_found
)

if exist "C:\xampp\php\php.exe" (
    set PHP_PATH=C:\xampp\php\php.exe
    set PHP_FOUND=1
    echo [✓] PHP found: XAMPP
    goto :php_found
)

if exist "C:\php\php.exe" (
    set PHP_PATH=C:\php\php.exe
    set PHP_FOUND=1
    echo [✓] PHP found: C:\php
    goto :php_found
)

echo [✗] PHP not found!
echo.
echo Please install PHP or add it to PATH
echo Download: https://windows.php.net/download/
echo.
pause
exit /b 1

:php_found
echo.

REM Check if database exists
if not exist "database\database.sqlite" (
    echo [!] Creating SQLite database...
    type nul > database\database.sqlite
    echo [✓] Database file created
)

REM Run migrations
echo.
echo [→] Running migrations...
"%PHP_PATH%" artisan migrate --force
if %ERRORLEVEL% NEQ 0 (
    echo [✗] Migration failed!
    echo.
    pause
    exit /b 1
)
echo [✓] Migrations completed
echo.

REM Build assets if needed
if not exist "public\build\manifest.json" (
    echo [→] Building CSS and JS assets...
    call npm install
    call npm run build
    if %ERRORLEVEL% EQU 0 (
        echo [✓] Assets built successfully
    ) else (
        echo [!] Asset build failed - continuing anyway...
    )
    echo.
)

REM Clear cache
echo [→] Clearing cache...
"%PHP_PATH%" artisan config:clear >nul 2>&1
"%PHP_PATH%" artisan cache:clear >nul 2>&1
"%PHP_PATH%" artisan view:clear >nul 2>&1
echo [✓] Cache cleared
echo.

REM Show URLs
echo ════════════════════════════════════════════════════
echo   پروژه آماده است!
echo ════════════════════════════════════════════════════
echo.
echo   [→] Starting server on http://localhost:8000
echo.
echo   صفحات قابل دسترسی:
echo   • http://localhost:8000/register    (ثبت‌نام)
echo   • http://localhost:8000/login       (ورود)
echo   • http://localhost:8000/account     (پنل مشتری)
echo   • http://localhost:8000/admin       (پنل ادمین)
echo.
echo   برای توقف سرور: Ctrl+C
echo.
echo ════════════════════════════════════════════════════
echo.

REM Start server
"%PHP_PATH%" artisan serve

pause
