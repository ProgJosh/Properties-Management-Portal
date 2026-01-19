#!/bin/bash

# Railway Diagnostic Script
# Run this on Railway to check configuration

echo "=========================================="
echo "Railway Environment Diagnostics"
echo "=========================================="
echo ""

echo "1. Checking PHP Version:"
php -v | head -n 1
echo ""

echo "2. Checking Laravel Version:"
php artisan --version
echo ""

echo "3. Checking Environment:"
echo "APP_ENV: ${APP_ENV:-NOT SET}"
echo "APP_DEBUG: ${APP_DEBUG:-NOT SET}"
echo "APP_URL: ${APP_URL:-NOT SET}"
echo ""

echo "4. Checking Session Configuration:"
echo "SESSION_DRIVER: ${SESSION_DRIVER:-NOT SET}"
echo "SESSION_SECURE_COOKIE: ${SESSION_SECURE_COOKIE:-NOT SET}"
echo "SESSION_DOMAIN: ${SESSION_DOMAIN:-NOT SET (this is OK)}"
echo ""

echo "5. Checking Database Connection:"
if php artisan migrate:status &> /dev/null; then
    echo "✓ Database connection successful"
    php artisan migrate:status | tail -n 5
else
    echo "✗ Database connection failed"
fi
echo ""

echo "6. Checking Sessions Table:"
if php artisan db:table sessions &> /dev/null; then
    echo "✓ Sessions table exists"
else
    echo "⚠ Sessions table might not exist"
    echo "Run: php artisan session:table && php artisan migrate"
fi
echo ""

echo "7. Checking Storage Permissions:"
if [ -w storage/framework/sessions ]; then
    echo "✓ Storage directory is writable"
else
    echo "✗ Storage directory is not writable"
fi
echo ""

echo "8. Checking Admin Users:"
php artisan tinker --execute="echo 'Admin count: ' . \App\Models\Admin::count();"
echo ""

echo "9. Testing Session:"
php artisan tinker --execute="session()->put('test', 'value'); echo 'Session test: ' . session('test');"
echo ""

echo "=========================================="
echo "Diagnostic Complete"
echo "=========================================="
echo ""
echo "Common Issues:"
echo "- If SESSION_SECURE_COOKIE is NOT SET, add it with value 'true'"
echo "- If APP_URL is NOT SET, add it with your Railway domain"
echo "- If Sessions table doesn't exist, run migrations"
echo ""
