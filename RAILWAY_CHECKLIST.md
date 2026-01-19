# Railway Deployment Checklist

## Pre-Deployment

- [ ] Railway project created
- [ ] MySQL database service added to Railway project
- [ ] Repository connected to Railway
- [ ] Local application works correctly

## Environment Variables Setup

### Critical Variables (Must Set!)
- [ ] `APP_URL=https://your-domain.up.railway.app` (your actual Railway domain)
- [ ] `APP_KEY=base64:xxxxx` (generate with `php artisan key:generate --show`)
- [ ] `SESSION_SECURE_COOKIE=true` (REQUIRED for HTTPS)
- [ ] `SESSION_DOMAIN=null` (must be null or unset)
- [ ] `APP_ENV=production`
- [ ] `APP_DEBUG=false`

### Session Variables
- [ ] `SESSION_DRIVER=database`
- [ ] `SESSION_LIFETIME=120`
- [ ] `SESSION_PATH=/`
- [ ] `SESSION_HTTP_ONLY=true`
- [ ] `SESSION_SAME_SITE=lax`

### Database Variables (Auto-provided by Railway)
- [ ] `DB_CONNECTION=mysql`
- [ ] `DB_HOST=${MYSQLHOST}`
- [ ] `DB_PORT=${MYSQLPORT}`
- [ ] `DB_DATABASE=${MYSQLDATABASE}`
- [ ] `DB_USERNAME=${MYSQLUSER}`
- [ ] `DB_PASSWORD=${MYSQLPASSWORD}`

### Optional but Recommended
- [ ] `SANCTUM_STATEFUL_DOMAINS=your-domain.up.railway.app`
- [ ] `CACHE_STORE=database`
- [ ] `QUEUE_CONNECTION=database`
- [ ] `LOG_CHANNEL=stack`
- [ ] `LOG_LEVEL=info`

## Code Changes

- [x] TrustProxies middleware created ([app/Http/Middleware/TrustProxies.php](app/Http/Middleware/TrustProxies.php))
- [x] Bootstrap app.php updated to trust proxies ([bootstrap/app.php](bootstrap/app.php))
- [x] Railway setup script created ([railway-setup.sh](railway-setup.sh))
- [x] Procfile created for Railway ([Procfile](Procfile))

## Deployment

- [ ] Code pushed to Git repository
- [ ] Railway detected changes and started deployment
- [ ] Deployment completed successfully (check Railway logs)
- [ ] No errors in deployment logs

## Post-Deployment Verification

- [ ] Visit `https://your-domain.up.railway.app` (site loads)
- [ ] Visit `https://your-domain.up.railway.app/admin/login` (login page loads)
- [ ] Can successfully login with admin credentials
- [ ] After login, redirects to `/admin/dashboard` (not back to login)
- [ ] Can navigate admin pages without being logged out
- [ ] Session persists across page refreshes

## Troubleshooting Steps (If Login Fails)

1. [ ] Check Railway deployment logs for errors
2. [ ] Verify `SESSION_SECURE_COOKIE=true` is set
3. [ ] Verify `APP_URL` matches Railway domain exactly (with https://)
4. [ ] Check database migrations ran (look in logs for "Migrating" messages)
5. [ ] Clear browser cookies/cache
6. [ ] Test in incognito/private window
7. [ ] Run diagnostic: `railway run bash railway-diagnose.sh`

## Common Errors and Solutions

| Error | Solution |
|-------|----------|
| "419 Page Expired" | Set `SESSION_SECURE_COOKIE=true` |
| Redirects to login after login | Check `APP_URL` and `SESSION_SECURE_COOKIE` |
| "Session store not set" | Set `SESSION_DRIVER=database` and run migrations |
| Database connection error | Verify MySQL service is linked in Railway |
| "APP_KEY not set" | Generate with `php artisan key:generate --show` |

## Quick Commands for Railway CLI

```bash
# Check environment
railway run php artisan config:show

# Clear caches
railway run php artisan config:clear
railway run php artisan cache:clear

# Run migrations
railway run php artisan migrate --force

# Check database
railway run php artisan migrate:status

# Test database connection
railway run php artisan tinker --execute="DB::connection()->getPdo();"

# Check admin users
railway run php artisan tinker --execute="\App\Models\Admin::count()"
```

## Help Documents

- [QUICK_FIX_RAILWAY_LOGIN.md](QUICK_FIX_RAILWAY_LOGIN.md) - Fast 5-minute fix
- [RAILWAY_DEPLOYMENT_FIX.md](RAILWAY_DEPLOYMENT_FIX.md) - Comprehensive deployment guide
- [RAILWAY_ENV_SETUP.md](RAILWAY_ENV_SETUP.md) - Detailed environment variables guide

## Success! 🎉

If all checkboxes are checked and login works, your deployment is complete!
