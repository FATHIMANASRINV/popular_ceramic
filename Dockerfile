# -----------------------------
# Stage 1: Composer dependencies
# -----------------------------
FROM composer:2.5 AS vendor

WORKDIR /var/www

# Copy composer files to leverage Docker cache
COPY composer.json composer.lock ./

# Install PHP dependencies (no dev)
RUN composer install --no-dev --optimize-autoloader --no-scripts

# -----------------------------
# Stage 2: PHP-FPM
# -----------------------------
FROM php:8.2-fpm

WORKDIR /var/www

# Install PHP extensions + MySQL PDO + OPcache
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    default-libmysqlclient-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd \
    && docker-php-ext-enable opcache \
    && rm -rf /var/lib/apt/lists/*

# Copy OPcache configuration
COPY opcache.ini /usr/local/etc/php/conf.d/

# Copy vendor from stage 1
COPY --from=vendor /var/www/vendor ./vendor

# Copy Laravel app code
COPY . .

# Set permissions for storage & cache
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Laravel: clear caches, migrate, seed, optimize
RUN php artisan config:clear \
    && php artisan cache:clear \
    && php artisan route:clear \
    && php artisan view:clear \
    && php artisan migrate --force \
    && php artisan db:seed \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache \
    && php artisan optimize

# Expose port
EXPOSE 8000

# Serve Laravel
CMD php artisan serve --host=0.0.0.0 --port=8000
