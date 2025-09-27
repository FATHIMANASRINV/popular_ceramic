# Stage 1: Composer dependencies (caches vendor for faster builds)
FROM composer:2.5 AS vendor

WORKDIR /var/www

# Copy composer files only to leverage Docker cache
COPY composer.json composer.lock ./

# Install PHP dependencies (no dev)
RUN composer install --no-dev --optimize-autoloader

# Stage 2: PHP-FPM
FROM php:8.2-fpm

WORKDIR /var/www

# Install PHP extensions + MySQL PDO + enable OPcache
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

# Copy OPcache config
COPY opcache.ini /usr/local/etc/php/conf.d/

# Copy vendor from previous stage
COPY --from=vendor /var/www/vendor ./vendor

# Copy the rest of the application
COPY . .

# Set permissions for storage & bootstrap/cache
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Laravel optimization (precompile configs, routes, views)
RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache \
    && php artisan optimize

# Expose port
EXPOSE 8000

# CMD: Run migrations (force), then serve Laravel
CMD php artisan migrate --force && \
    php artisan serve --host=0.0.0.0 --port=8000
