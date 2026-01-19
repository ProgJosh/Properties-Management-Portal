<<<<<<< HEAD


### Properties Management Portal

> **🚀 Deploying to Railway?** See [RAILWAY_INDEX.md](RAILWAY_INDEX.md) for complete deployment guides and admin login fixes.
 
## Table of Contents
 - Introduction
 - Features
 - Installation
 - Railway Deployment
 - Configuration
 - Contact


## Introduction

The Properties Management Portal is a comprehensive platform designed for managing real estate properties. It facilitates user, landlord, and admin interactions, property uploads, property browsing with advanced filtering options, and secure transactions via Stripe payment gateway.

## Features
 -  Tenant login and registration 
 -  Landlord login and registration
 -  Admin login and registration
 -  Properties upload with multiple images and details 
 -  Property browsing with advanced filtering options 
 -  Property view with details and gallery
 -  Booking and payment  
 -  Secure transactions via Stripe payment gateway 
 -  Admin control panel for managing users, properties, and payments

## Installation
To get a local copy up and running, follow these steps.

# Prerequisites
 - PHP 8.2.4
 - Composer
 - MySQL
 - Node.js & NPM

## Steps
1. Clone the repository:
```bash
git clone https://github.com/creativesaiful/Properties-Management-Portal.git
```
2. Install dependencies:
```bash
cd properties-management
composer install
```
3. Copy .env.example to .env:

4. Create a database on your phpmyadmin or mysql server with any name. Paste the database name in .env file and configure it. 
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your-database
DB_USERNAME=your-username
DB_PASSWORD=your-password
```

5. Install NPM packages:

```bash
npm install 
npm run build
```

6. Run migrations:

```bash
php artisan migrate
```
7. Seed the database

```bash
php artisan db:seed
```
8. Generate application key:

```bash
php artisan key:generate
```
9. Link the storage folder:

```bash
php artisan storage:link
```


10. Run the server:

```bash
php artisan serve
```

11. Visit http://localhost:8000 in your browser.
12. Visit http://localhost:8000/admin/login in your browser to login as admin.

## Railway Deployment 🚀

Deploy your Properties Management Portal to Railway with ease!

### Quick Deployment Fix

If your admin login is not working on Railway, see:
- **[QUICK_FIX_RAILWAY_LOGIN.md](QUICK_FIX_RAILWAY_LOGIN.md)** - 5-minute quick fix

### Comprehensive Deployment Guides

- **[RAILWAY_CHECKLIST.md](RAILWAY_CHECKLIST.md)** - Step-by-step deployment checklist
- **[RAILWAY_DEPLOYMENT_FIX.md](RAILWAY_DEPLOYMENT_FIX.md)** - Complete deployment guide
- **[RAILWAY_ENV_SETUP.md](RAILWAY_ENV_SETUP.md)** - Environment variables configuration

### Common Railway Issues

**Admin login not working?**
- Most likely cause: Missing `SESSION_SECURE_COOKIE=true` environment variable
- See [QUICK_FIX_RAILWAY_LOGIN.md](QUICK_FIX_RAILWAY_LOGIN.md) for immediate solution

**Session not persisting?**
- Check your `APP_URL` environment variable matches your Railway domain
- Ensure `SESSION_DOMAIN=null` in environment variables
