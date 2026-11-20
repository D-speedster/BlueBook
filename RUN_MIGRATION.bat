@echo off
echo ==========================================
echo Running Database Migrations
echo ==========================================
echo.

REM Try to find PHP
where php >nul 2>&1
if %ERRORLEVEL% EQU 0 (
    echo PHP found in PATH
    php artisan migrate --force
    goto :end
)

REM Check common PHP locations
if exist "C:\php\php.exe" (
    echo PHP found at C:\php\php.exe
    C:\php\php.exe artisan migrate --force
    goto :end
)

if exist "C:\xampp\php\php.exe" (
    echo PHP found at C:\xampp\php\php.exe
    C:\xampp\php\php.exe artisan migrate --force
    goto :end
)

if exist "C:\laragon\bin\php\php-8.2\php.exe" (
    echo PHP found at C:\laragon\bin\php\php-8.2\php.exe
    C:\laragon\bin\php\php-8.2\php.exe artisan migrate --force
    goto :end
)

if exist "C:\laragon\bin\php\php-8.3\php.exe" (
    echo PHP found at C:\laragon\bin\php\php-8.3\php.exe
    C:\laragon\bin\php\php-8.3\php.exe artisan migrate --force
    goto :end
)

echo.
echo ERROR: PHP not found!
echo Please run manually: php artisan migrate
echo.

:end
echo.
echo Press any key to exit...
pause >nul
