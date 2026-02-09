### Properties Management Portal
 
## Table of Contents
 - Introduction
 - Features
 - Installation
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
 -  Terms of use for Landlord during Sign-up
 -  Warning notice for terms of Use of Admin to the Landlord during sign-up
 -  Informing of commission cost during land lord sign up/registration
 -  Monthly payment reminder
 -  Lease agreement
-lease or existing contract on the tenant and landlord side should not be deleted until the end of agreement
 -  USER VALIDATION- valid ID requirements for sign up (included in the process of lease contract)
 -  Localized Address (Street, Purok, Barangay Level)
 - Uploading Thumbnail/Gallery photo for landlord the picture size must be 25 mb (file size or dimensional)
 - Do’s and Dont’s Policy in terms of Renting Agreement between Tenant and Landlord
 - Age Liimit on User Registration

## Installation
To get a local copy up and running, follow these steps.

# Prerequisites
 - PHP 8.2.4
 - Composer
 - MySQL
 - Node.js & NPM

## Steps
1. Install dependencies:
```bash
cd properties-management
composer install
`````
2. Copy .env.example to .env:
3. Create a database on your phpmyadmin or mysql server with any name. Paste the
database name in .env file and configure it.
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your-database
DB_USERNAME=your-username
DB_PASSWORD=your-password
```
4. Install NPM packages:

```bash
npm install 
npm run build
```
5. Run migrations:

```bash
php artisan migrate
```
6. Seed the database

```bash
php artisan db:seed
```
7. Generate application key:

```bash
php artisan key:generate
```
8. Link the storage folder:

```bash
php artisan storage:link
```
9. Run the server:

```bash
php artisan serve
```
10. Visit http://localhost:8000 in your browser.
11. Visit http://localhost:8000/admin/login in your browser to login as admin.
