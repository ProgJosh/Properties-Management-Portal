# Railway Quick Commands Reference

Useful commands for managing your Railway deployment. Run these using Railway CLI or in Railway's shell.

## Prerequisites

Install Railway CLI:
```bash
# Using npm
npm install -g @railway/cli

# Or using curl (Linux/macOS)
curl -fsSL https://railway.app/install.sh | sh
```

Login to Railway:
```bash
railway login
```

Link to your project:
```bash
railway link
```

---

## 🚀 Deployment Commands

### Deploy Application
```bash
# Trigger deployment from current branch
railway up

# Deploy specific service
railway up --service <service-name>
```

### View Deployment Status
```bash
# Check deployment status
railway status

# View recent deployments
railway deployments
```

---

## 🔧 Configuration Commands

### Environment Variables
```bash
# List all environment variables
railway variables

# Set a variable
railway variables set SESSION_SECURE_COOKIE=true

# Set multiple variables from .env file
railway variables set --from .env.railway

# Delete a variable
railway variables delete VARIABLE_NAME
```

### View Logs
```bash
# View live logs
railway logs

# View logs for specific service
railway logs --service <service-name>

# Follow logs (continuous)
railway logs --follow
```

---

## 🗄️ Database Commands

### Connect to Database
```bash
# Open database shell
railway run mysql -u root -p

# Execute SQL query
railway run mysql -u root -p -e "SHOW DATABASES;"
```

### Database Migrations
```bash
# Run migrations
railway run php artisan migrate --force

# Check migration status
railway run php artisan migrate:status

# Rollback migrations
railway run php artisan migrate:rollback --force

# Fresh migrations (WARNING: Deletes all data)
railway run php artisan migrate:fresh --force --seed
```

---

## 🧹 Cache & Optimization Commands

### Clear Caches
```bash
# Clear all caches
railway run php artisan optimize:clear

# Clear config cache
railway run php artisan config:clear

# Clear route cache
railway run php artisan route:clear

# Clear view cache
railway run php artisan view:clear

# Clear application cache
railway run php artisan cache:clear
```

### Build Caches
```bash
# Cache configuration
railway run php artisan config:cache

# Cache routes
railway run php artisan route:cache

# Cache views
railway run php artisan view:cache

# Optimize for production
railway run php artisan optimize
```

---

## 🔍 Debugging Commands

### Application Information
```bash
# Check Laravel version
railway run php artisan --version

# Check PHP version
railway run php -v

# Check environment
railway run php artisan env

# View application configuration
railway run php artisan config:show
```

### Database Checks
```bash
# Test database connection
railway run php artisan db:show

# List database tables
railway run php artisan db:table --database=mysql

# Check sessions table
railway run php artisan tinker --execute="DB::table('sessions')->count()"

# Check admin users
railway run php artisan tinker --execute="\App\Models\Admin::count()"

# List all admins
railway run php artisan tinker --execute="\App\Models\Admin::all(['id','name','email'])"
```

### Run Diagnostics
```bash
# Run custom diagnostic script
railway run bash railway-diagnose.sh

# Check storage permissions
railway run ls -la storage/

# Check .env file
railway run php artisan config:show | grep -i session
```

---

## 👤 User Management Commands

### Create Admin User
```bash
# Using tinker
railway run php artisan tinker --execute="
\App\Models\Admin::create([
    'name' => 'Admin User',
    'email' => 'admin@example.com',
    'password' => bcrypt('password123'),
    'role' => '0'
]);"
```

### Reset Admin Password
```bash
# Using tinker
railway run php artisan tinker --execute="
\$admin = \App\Models\Admin::where('email', 'admin@example.com')->first();
\$admin->password = bcrypt('newpassword123');
\$admin->save();
echo 'Password updated';"
```

### List All Users
```bash
# List admins
railway run php artisan tinker --execute="\App\Models\Admin::all()"

# Count users by type
railway run php artisan tinker --execute="
echo 'Admins: ' . \App\Models\Admin::count() . PHP_EOL;
echo 'Users: ' . \App\Models\User::count();"
```

---

## 🗂️ File & Storage Commands

### Storage Management
```bash
# Create storage symlink
railway run php artisan storage:link

# Check storage disk
railway run php artisan storage:list

# Clear temp files
railway run rm -rf storage/framework/cache/*
railway run rm -rf storage/framework/sessions/*
railway run rm -rf storage/framework/views/*
```

### File Permissions
```bash
# Fix storage permissions
railway run chmod -R 775 storage bootstrap/cache
```

---

## 🎯 Quick Fixes

### Fix Admin Login Issues
```bash
# 1. Clear all caches
railway run php artisan optimize:clear

# 2. Run migrations
railway run php artisan migrate --force

# 3. Cache config
railway run php artisan config:cache

# 4. Check session table exists
railway run php artisan tinker --execute="DB::table('sessions')->count()"
```

### Reset Application
```bash
# Warning: This clears everything
railway run php artisan optimize:clear
railway run php artisan config:cache
railway run php artisan route:cache
railway run php artisan view:cache
```

### Check Critical Settings
```bash
# Check if SESSION_SECURE_COOKIE is set
railway variables | grep SESSION_SECURE_COOKIE

# Check APP_URL
railway variables | grep APP_URL

# Check database connection
railway run php artisan db:show
```

---

## 📊 Monitoring Commands

### Health Check
```bash
# Check if app is responding
curl https://your-app.up.railway.app/up

# Check admin login page
curl -I https://your-app.up.railway.app/admin/login
```

### Performance
```bash
# View route list with performance info
railway run php artisan route:list

# Check queue status (if using queues)
railway run php artisan queue:work --once
```

---

## 🛠️ Maintenance Commands

### Put App in Maintenance Mode
```bash
# Enable maintenance mode
railway run php artisan down

# Disable maintenance mode
railway run php artisan up

# Down with secret bypass
railway run php artisan down --secret="your-secret-key"
# Access: https://your-app.up.railway.app/your-secret-key
```

### Backup Database
```bash
# Export database
railway run mysqldump -u root -p database_name > backup.sql

# Import database
railway run mysql -u root -p database_name < backup.sql
```

---

## 🔐 Security Commands

### Generate New App Key
```bash
# Generate and show key (copy to Railway variables)
railway run php artisan key:generate --show

# Generate and set automatically
railway run php artisan key:generate --force
```

### Clear Sessions
```bash
# Clear all sessions
railway run php artisan session:clear

# Or via database
railway run php artisan tinker --execute="DB::table('sessions')->truncate()"
```

---

## 📝 Development Commands

### Run Tests
```bash
# Run all tests
railway run php artisan test

# Run specific test
railway run php artisan test --filter=TestName
```

### Seed Database
```bash
# Run all seeders
railway run php artisan db:seed --force

# Run specific seeder
railway run php artisan db:seed --class=AdminSeeder --force
```

---

## 💡 Pro Tips

### Create Custom Commands
```bash
# Run any artisan command
railway run php artisan <command>

# Run any shell command
railway run <command>

# Run interactive PHP
railway run php artisan tinker
```

### Chain Multiple Commands
```bash
# Clear caches and rebuild
railway run bash -c "php artisan optimize:clear && php artisan config:cache && php artisan route:cache"

# Deploy and clear caches
railway up && railway run php artisan optimize:clear
```

### Save Frequently Used Commands
Create aliases in your local shell:
```bash
# Add to ~/.bashrc or ~/.zshrc
alias rdeploy='railway up'
alias rlogs='railway logs --follow'
alias rclear='railway run php artisan optimize:clear'
alias rmigrate='railway run php artisan migrate --force'
```

---

## 🆘 Emergency Commands

### If App is Completely Broken
```bash
# 1. Check logs
railway logs

# 2. Clear everything
railway run php artisan optimize:clear

# 3. Rebuild caches
railway run php artisan config:cache

# 4. Check database
railway run php artisan migrate:status

# 5. Run diagnostics
railway run bash railway-diagnose.sh

# 6. If nothing works, rollback deployment
railway deployments
# Note the working deployment ID
railway rollback <deployment-id>
```

---

## 📚 Additional Resources

- Railway CLI Docs: https://docs.railway.app/develop/cli
- Laravel Artisan Docs: https://laravel.com/docs/artisan
- Railway Deployment Guide: [RAILWAY_DEPLOYMENT_FIX.md](RAILWAY_DEPLOYMENT_FIX.md)
- Quick Fix Guide: [QUICK_FIX_RAILWAY_LOGIN.md](QUICK_FIX_RAILWAY_LOGIN.md)

---

## 🎓 Common Command Patterns

```bash
# Pattern: railway run <command>
railway run php artisan migrate --force
railway run composer install
railway run npm run build

# Pattern: railway variables <action>
railway variables set KEY=value
railway variables delete KEY
railway variables

# Pattern: railway <action>
railway up
railway logs
railway status
railway link
```

---

**Remember:** Always use `--force` flag with artisan commands that require confirmation (migrate, db:seed, etc.) since Railway runs in non-interactive mode.
