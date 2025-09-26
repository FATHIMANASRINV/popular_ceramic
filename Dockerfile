# ----------------------------- 
# Stage 1: Composer dependencies
# -----------------------------
FROM composer:2.5 AS vendor

WORKDIR /var/www

# Copy composer files to leverage Docker cache
COPY composer.json composer.lock ./

# Install PHP dependencies (no dev, no scripts)
RUN composer install --no-dev --optimize-autoloader --no-scripts

# -----------------------------
# Stage 2: PHP-FPM
# -----------------------------
FROM php:8.2-fpm

WORKDIR /var/www

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    default-mysql-client \
    default-libmysqlclient-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd \
    && docker-php-ext-enable opcache \
    && rm -rf /var/lib/apt/lists/*

# Copy OPcache configuration
COPY opcache.ini /usr/local/etc/php/conf.d/

# Copy vendor from stage 1
COPY --from=vendor /var/www/vendor ./vendor

# Copy Laravel application
COPY . .

# Set correct permissions
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Laravel optimization (do NOT run migrations here)
RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache \
    && php artisan optimize

# Copy entrypoint script
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Expose port
EXPOSE 8000

# Use entrypoint to run migrations and serve Laravel
CMD ["docker-entrypoint.sh"]
