#!/usr/bin/env bash
echo "Running composer"
composer install --no-dev --working-dir=/var/www/html

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Running migrations..."
php artisan migrate --force

echo "Installing npm dependencies..."
npm install --prefix /var/www/html

echo "Running npm build..."
npm run build --prefix /var/www/html