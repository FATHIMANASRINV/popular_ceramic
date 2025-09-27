#!/bin/sh
set -e

# Optional: clear caches before migrations
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Run migrations & seed (only at runtime)
php artisan migrate --force
php artisan db:seed

# Serve Laravel
php artisan serve --host=0.0.0.0 --port=8000
