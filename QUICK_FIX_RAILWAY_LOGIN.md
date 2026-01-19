# Quick Fix: Admin Login Not Working on Railway

## 🚨 Most Common Cause
Missing `SESSION_SECURE_COOKIE=true` environment variable on Railway.

## ⚡ Quick Fix (5 minutes)

### Step 1: Set Critical Environment Variables on Railway

1. Go to your Railway project
2. Click on your service
3. Go to **Variables** tab
4. Add these THREE critical variables:

```
SESSION_SECURE_COOKIE=true
SESSION_DOMAIN=null
APP_URL=https://your-railway-domain.up.railway.app
```

**Replace `your-railway-domain.up.railway.app` with your actual Railway domain!**

### Step 2: Redeploy

After adding variables, Railway will automatically redeploy. Wait for it to complete.

### Step 3: Test

Visit: `https://your-railway-domain.up.railway.app/admin/login`

Login should now work! ✅

---

## 🔧 If Quick Fix Doesn't Work

### Check These Variables Are Set:

```bash
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:xxxxx  (must be set!)
SESSION_DRIVER=database
SESSION_SECURE_COOKIE=true
SESSION_DOMAIN=null
```

### Run These Commands on Railway:

You can run these in Railway's "Deploy Logs" or using Railway CLI:

```bash
# Clear all caches
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Run migrations
php artisan migrate --force

# Cache configs
php artisan config:cache
```

### Check Railway Logs:

1. Go to your service in Railway
2. Click **Deployments**
3. Click latest deployment
4. Look for errors in logs

Common errors to look for:
- "Session store not set"
- "SQLSTATE[HY000]" (database connection)
- "419 Page Expired" (CSRF/session issue)

---

## 🐛 Debugging Checklist

- [ ] `SESSION_SECURE_COOKIE=true` is set on Railway
- [ ] `APP_URL` matches your Railway domain (with https://)
- [ ] `APP_KEY` is generated and set
- [ ] Database is connected (check Railway MySQL service)
- [ ] `php artisan migrate` ran successfully (check deploy logs)
- [ ] Sessions table exists in database
- [ ] Browser cookies are enabled
- [ ] Not using incognito/private browsing

---

## 🎯 Why This Happens

Railway uses **HTTPS** by default. Laravel requires `SESSION_SECURE_COOKIE=true` to send session cookies over HTTPS. Without this, the session cookie is never sent to the browser, so every request appears as a new session, and login fails.

---

## 📋 Complete Environment Variables Template

Copy this to Railway's Raw Editor (Variables tab → Raw Editor):

```env
APP_NAME=Properties Management Portal
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-railway-domain.up.railway.app
APP_KEY=base64:YOUR_KEY_HERE

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_SECURE_COOKIE=true
SESSION_DOMAIN=null
SESSION_PATH=/
SESSION_HTTP_ONLY=true
SESSION_SAME_SITE=lax

DB_CONNECTION=mysql
DB_HOST=${MYSQLHOST}
DB_PORT=${MYSQLPORT}
DB_DATABASE=${MYSQLDATABASE}
DB_USERNAME=${MYSQLUSER}
DB_PASSWORD=${MYSQLPASSWORD}

SANCTUM_STATEFUL_DOMAINS=your-railway-domain.up.railway.app

CACHE_STORE=database
QUEUE_CONNECTION=database
LOG_CHANNEL=stack
LOG_LEVEL=info
```

**Don't forget to:**
1. Replace `your-railway-domain.up.railway.app` with your actual domain
2. Generate APP_KEY: run `php artisan key:generate --show` locally
3. Make sure MySQL service is added and linked in Railway

---

## 💡 Pro Tips

1. **Always use HTTPS in APP_URL** on Railway (not http://)
2. **Never hardcode SESSION_DOMAIN** - leave it null for flexibility
3. **Check Railway logs** after every deployment
4. **Clear browser cache** if you were testing before the fix
5. **Test in a new incognito window** to avoid old cookies

---

## 📞 Still Not Working?

1. Check [RAILWAY_ENV_SETUP.md](RAILWAY_ENV_SETUP.md) for detailed setup
2. Check [RAILWAY_DEPLOYMENT_FIX.md](RAILWAY_DEPLOYMENT_FIX.md) for comprehensive guide
3. Run `railway-diagnose.sh` on Railway to get diagnostic info
4. Check Railway community forums or Discord

---

## ✅ Success Indicators

You'll know it's working when:
- ✓ Login redirects to `/admin/dashboard` (not back to login)
- ✓ Admin name appears in the top-right corner
- ✓ No "419 Page Expired" errors
- ✓ Can navigate between admin pages without being logged out
