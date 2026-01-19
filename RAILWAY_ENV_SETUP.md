# Railway Environment Variables Configuration

## Required Environment Variables

Copy these to your Railway project's environment variables section:

### Application Settings
```
APP_NAME="Properties Management Portal"
APP_ENV=production
APP_DEBUG=false
APP_TIMEZONE=UTC
APP_URL=https://your-app-name.up.railway.app
```

**Important:** Replace `your-app-name.up.railway.app` with your actual Railway domain!

### Application Key
```
APP_KEY=
```
Generate this by running locally: `php artisan key:generate --show`
Then copy the entire output (including "base64:") to Railway.

### Session Configuration (CRITICAL FOR LOGIN)
```
SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null
SESSION_SECURE_COOKIE=true
SESSION_HTTP_ONLY=true
SESSION_SAME_SITE=lax
```

**Why these matter:**
- `SESSION_SECURE_COOKIE=true` - Required for HTTPS (Railway uses HTTPS)
- `SESSION_DOMAIN=null` - Don't restrict cookie to specific domain
- `SESSION_DRIVER=database` - Store sessions in database (persistent)

### Database Configuration
Railway automatically provides these when you add MySQL service:
```
DB_CONNECTION=mysql
DB_HOST=${MYSQLHOST}
DB_PORT=${MYSQLPORT}
DB_DATABASE=${MYSQLDATABASE}
DB_USERNAME=${MYSQLUSER}
DB_PASSWORD=${MYSQLPASSWORD}
```

### Sanctum Configuration (For API/SPA Authentication)
```
SANCTUM_STATEFUL_DOMAINS=your-app-name.up.railway.app
```
Replace with your Railway domain (without https://)

### Cache & Queue
```
CACHE_STORE=database
QUEUE_CONNECTION=database
```

### Mail Configuration (Optional)
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@yourapp.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### Logging
```
LOG_CHANNEL=stack
LOG_LEVEL=info
```

## How to Set Variables on Railway

1. Go to your Railway project
2. Click on your service
3. Navigate to the "Variables" tab
4. Click "New Variable"
5. Add each variable one by one (or use "Raw Editor" to paste all at once)

## Railway Raw Editor Format

Click "Raw Editor" in Variables tab and paste:

```
APP_NAME=Properties Management Portal
APP_ENV=production
APP_DEBUG=false
APP_TIMEZONE=UTC
APP_URL=https://your-app-name.up.railway.app
APP_KEY=base64:YOUR_KEY_HERE

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null
SESSION_SECURE_COOKIE=true
SESSION_HTTP_ONLY=true
SESSION_SAME_SITE=lax

DB_CONNECTION=mysql
DB_HOST=${MYSQLHOST}
DB_PORT=${MYSQLPORT}
DB_DATABASE=${MYSQLDATABASE}
DB_USERNAME=${MYSQLUSER}
DB_PASSWORD=${MYSQLPASSWORD}

SANCTUM_STATEFUL_DOMAINS=your-app-name.up.railway.app

CACHE_STORE=database
QUEUE_CONNECTION=database

LOG_CHANNEL=stack
LOG_LEVEL=info
```

## After Setting Variables

1. Click "Deploy" or wait for auto-deploy
2. Once deployed, go to your Railway service logs
3. Verify no errors in the logs
4. Visit `https://your-app-name.up.railway.app/admin/login`
5. Test admin login

## Troubleshooting

### Login redirects to login page
- Check `SESSION_SECURE_COOKIE=true` is set
- Verify `APP_URL` matches your Railway domain exactly
- Check Railway logs for session errors

### "CSRF token mismatch"
- Clear browser cookies for your site
- Verify `SESSION_DOMAIN=null`
- Check APP_URL is correct

### Database connection error
- Make sure MySQL service is linked in Railway
- Verify database variables are using Railway's provided values

### Still not working?
1. Check Railway logs: Click your service → Deployments → Latest deployment → View logs
2. Look for PHP errors or session warnings
3. Verify all migrations ran successfully in logs
