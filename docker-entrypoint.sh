#!/bin/sh
set -e

echo "🚀 Starting Laravel container..."

# Clear old caches
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Run migrations & seeders in production (force = no prompt)
php artisan migrate --force
php artisan db:seed --force || true   # optional: ignore if no seeder

# Rebuild caches
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

# Start Laravel
exec php artisan serve --host=0.0.0.0 --port=8000
