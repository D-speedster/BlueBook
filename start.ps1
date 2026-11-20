#Requires -Version 5.1
<#
.SYNOPSIS
    BlueBook Quick Start Script
.DESCRIPTION
    Automatically finds PHP, runs migrations, and starts the development server
.EXAMPLE
    .\start.ps1
#>

[Console]::OutputEncoding = [System.Text.Encoding]::UTF8

Write-Host ""
Write-Host "╔════════════════════════════════════════════════════╗" -ForegroundColor Cyan
Write-Host "║         BlueBook - اجرای سریع پروژه                ║" -ForegroundColor Cyan
Write-Host "╚════════════════════════════════════════════════════╝" -ForegroundColor Cyan
Write-Host ""

# Find PHP
$phpPaths = @(
    "php",
    "C:\laragon\bin\php\php-8.3\php.exe",
    "C:\laragon\bin\php\php-8.2\php.exe",
    "C:\xampp\php\php.exe",
    "C:\php\php.exe",
    "C:\wamp64\bin\php\php8.2\php.exe"
)

$phpExe = $null

foreach ($path in $phpPaths) {
    try {
        if ($path -eq "php") {
            $result = Get-Command php -ErrorAction SilentlyContinue
            if ($result) {
                $phpExe = "php"
                Write-Host "[✓] PHP found in PATH" -ForegroundColor Green
                break
            }
        } elseif (Test-Path $path -PathType Leaf) {
            $phpExe = $path
            $version = & $phpExe -v 2>&1 | Select-Object -First 1
            Write-Host "[✓] PHP found: $path" -ForegroundColor Green
            break
        }
    } catch {
        continue
    }
}

if (-not $phpExe) {
    Write-Host "[✗] PHP not found!" -ForegroundColor Red
    Write-Host ""
    Write-Host "Please install PHP or add it to PATH" -ForegroundColor Yellow
    Write-Host "Download: https://windows.php.net/download/" -ForegroundColor Yellow
    Write-Host ""
    Read-Host "Press Enter to exit"
    exit 1
}

Write-Host ""

# Check if database exists
if (-not (Test-Path "database\database.sqlite")) {
    Write-Host "[!] Creating SQLite database..." -ForegroundColor Yellow
    New-Item -ItemType File -Path "database\database.sqlite" -Force | Out-Null
    Write-Host "[✓] Database file created" -ForegroundColor Green
}

# Run migrations
Write-Host ""
Write-Host "[→] Running migrations..." -ForegroundColor Yellow
try {
    & $phpExe artisan migrate --force
    if ($LASTEXITCODE -eq 0) {
        Write-Host "[✓] Migrations completed" -ForegroundColor Green
    } else {
        throw "Migration failed"
    }
} catch {
    Write-Host "[✗] Migration failed!" -ForegroundColor Red
    Write-Host $_.Exception.Message -ForegroundColor Red
    Write-Host ""
    Read-Host "Press Enter to exit"
    exit 1
}

Write-Host ""

# Clear cache
Write-Host "[→] Clearing cache..." -ForegroundColor Yellow
& $phpExe artisan config:clear | Out-Null
& $phpExe artisan cache:clear | Out-Null
& $phpExe artisan view:clear | Out-Null
Write-Host "[✓] Cache cleared" -ForegroundColor Green

Write-Host ""
Write-Host "════════════════════════════════════════════════════" -ForegroundColor Cyan
Write-Host "  پروژه آماده است!" -ForegroundColor Green
Write-Host "════════════════════════════════════════════════════" -ForegroundColor Cyan
Write-Host ""
Write-Host "  [→] Starting server on http://localhost:8000" -ForegroundColor Yellow
Write-Host ""
Write-Host "  صفحات قابل دسترسی:" -ForegroundColor White
Write-Host "  • http://localhost:8000/register    (ثبت‌نام)" -ForegroundColor Cyan
Write-Host "  • http://localhost:8000/login       (ورود)" -ForegroundColor Cyan
Write-Host "  • http://localhost:8000/account     (پنل مشتری)" -ForegroundColor Cyan
Write-Host "  • http://localhost:8000/admin       (پنل ادمین)" -ForegroundColor Cyan
Write-Host ""
Write-Host "  برای توقف سرور: Ctrl+C" -ForegroundColor Yellow
Write-Host ""
Write-Host "════════════════════════════════════════════════════" -ForegroundColor Cyan
Write-Host ""

# Start server
& $phpExe artisan serve
