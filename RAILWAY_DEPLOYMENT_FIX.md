# Railway Deployment Fix - Admin Login Issue

## Problem
Admin login page not working on Railway (sessions not persisting, authentication failing)

## Root Causes
1. SESSION_SECURE_COOKIE not set for HTTPS
2. APP_URL pointing to localhost instead of Railway domain
3. Missing trusted proxy configuration
4. SESSION_DOMAIN misconfiguration

## Solution

### Step 1: Update Environment Variables on Railway

Go to your Railway project settings and set these environment variables:

```env
# Application URL (replace with your Railway domain)
APP_URL=https://your-app-name.up.railway.app
APP_ENV=production
APP_DEBUG=false

# Session Configuration (CRITICAL for HTTPS)
SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null
SESSION_SECURE_COOKIE=true
SESSION_HTTP_ONLY=true
SESSION_SAME_SITE=lax

# Sanctum Configuration
SANCTUM_STATEFUL_DOMAINS=your-app-name.up.railway.app

# Database (Railway provides these automatically)
DB_CONNECTION=mysql
DB_HOST=${MYSQLHOST}
DB_PORT=${MYSQLPORT}
DB_DATABASE=${MYSQLDATABASE}
DB_USERNAME=${MYSQLUSER}
DB_PASSWORD=${MYSQLPASSWORD}

# Make sure APP_KEY is generated
# Run: php artisan key:generate --show
APP_KEY=base64:YOUR_GENERATED_KEY_HERE
```

### Step 2: Configure Trusted Proxies

Laravel needs to trust Railway's proxy to handle HTTPS correctly.

Update `app/Http/Middleware/TrustProxies.php`:

```php
protected $proxies = '*';
```

### Step 3: Verify Session Table Exists

Make sure your sessions table is created in the database:

```bash
php artisan migrate
```

### Step 4: Clear Cache on Railway

After updating environment variables, run:

```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

### Step 5: Test Login

1. Visit `https://your-app-name.up.railway.app/admin/login`
2. Enter admin credentials
3. Login should now work correctly

## Verification Checklist

- [ ] APP_URL matches your Railway domain (with https://)
- [ ] SESSION_SECURE_COOKIE=true
- [ ] SESSION_DOMAIN=null (not set to a specific domain)
- [ ] Trusted proxies configured
- [ ] Database migrations run successfully
- [ ] Cache cleared after env changes
- [ ] Can successfully login and stay logged in

## Quick Fix Commands

Run these in Railway's deployment or through Railway CLI:

```bash
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Additional Notes

- Railway automatically provides MySQL connection variables
- Always use `SESSION_SECURE_COOKIE=true` for production HTTPS
- Never set `SESSION_DOMAIN` to a specific domain unless you know what you're doing
- The `*` in TrustProxies tells Laravel to trust all proxies (safe on Railway)
