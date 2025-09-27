# Stage 1: Composer dependencies
FROM composer:2.5 AS vendor

WORKDIR /var/www

# Copy composer files only to leverage cache
COPY composer.json composer.lock ./

# Install PHP dependencies (no dev)
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Stage 2: PHP-FPM
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

# Copy OPcache config
COPY opcache.ini /usr/local/etc/php/conf.d/

# Copy vendor from stage 1
COPY --from=vendor /var/www/vendor ./vendor

# Copy Laravel application
COPY . .

# Set correct permissions
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Optimize Laravel (configs, routes, views)
RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache \
    && php artisan optimize

# Expose port
EXPOSE 8000

# CMD: Serve Laravel (do not run migrations here)
CMD php artisan serve --host=0.0.0.0 --port=8000
