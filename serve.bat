@echo off
title BlueBook Server

echo Starting BlueBook...
echo.

REM Find PHP
where php >nul 2>&1
if %ERRORLEVEL% EQU 0 (
    php artisan serve
    goto :end
)

if exist "C:\laragon\bin\php\php-8.3\php.exe" (
    C:\laragon\bin\php\php-8.3\php.exe artisan serve
    goto :end
)

if exist "C:\laragon\bin\php\php-8.2\php.exe" (
    C:\laragon\bin\php\php-8.2\php.exe artisan serve
    goto :end
)

if exist "C:\xampp\php\php.exe" (
    C:\xampp\php\php.exe artisan serve
    goto :end
)

echo PHP not found! Please install PHP.
pause

:end
