# ===============================
# Stage 1 - Build Frontend (Vite)
# ===============================
FROM node:18 AS frontend

WORKDIR /app

COPY package*.json ./
RUN npm install

COPY . .
RUN npm run build


# ===============================
# Stage 2 - Laravel + PHP
# ===============================
FROM php:8.2

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    libpq-dev \
    libonig-dev \
    libzip-dev \
    zip \
    && docker-php-ext-install pdo pdo_mysql mbstring zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy Laravel files
COPY . .

# Copy frontend build
COPY --from=frontend /app/public/build ./public/build

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Clear cache
RUN php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear

EXPOSE 8000

CMD php artisan serve --host=0.0.0.0 --port=8000