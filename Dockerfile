# Stage 1: Composer dependencies (cache vendor)
FROM composer:2.5 AS vendor
WORKDIR /var/www
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Stage 2: PHP-FPM
FROM php:8.2-fpm
WORKDIR /var/www

# Install PHP extensions + OPcache
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip default-libmysqlclient-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd \
    && docker-php-ext-enable opcache \
    && rm -rf /var/lib/apt/lists/*

# Copy OPcache config
COPY opcache.ini /usr/local/etc/php/conf.d/

# Copy vendor from stage 1
COPY --from=vendor /var/www/vendor ./vendor

# Copy app code
COPY . .

# Run Laravel package discovery
RUN php artisan package:discover --ansi

# Set permissions
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Laravel caching
RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache \
    && php artisan optimize

EXPOSE 8000

# CMD: Only serve Laravel
CMD php artisan serve --host=0.0.0.0 --port=8000
