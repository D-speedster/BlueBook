@echo off
title Build Assets

echo.
echo ================================================
echo          Building CSS and JS Assets
echo ================================================
echo.

REM Check if node is installed
where npm >nul 2>&1
if %ERRORLEVEL% NEQ 0 (
    echo [X] npm not found!
    echo.
    echo Please install Node.js from: https://nodejs.org/
    echo.
    pause
    exit /b 1
)

echo [OK] npm found
echo.

REM Install dependencies
echo [->] Installing npm packages...
call npm install
if %ERRORLEVEL% NEQ 0 (
    echo [X] npm install failed!
    pause
    exit /b 1
)
echo [OK] Packages installed
echo.

REM Build assets
echo [->] Building assets with Vite...
call npm run build
if %ERRORLEVEL% NEQ 0 (
    echo [X] Build failed!
    pause
    exit /b 1
)
echo.
echo [OK] Assets built successfully!
echo.

echo ================================================
echo   CSS and JS files are ready in public/build/
echo ================================================
echo.

pause
