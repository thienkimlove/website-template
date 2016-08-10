#!/usr/bin/env bash
setup_laravel() {

composer install

php artisan key:generate
php artisan ide-helper:generate

chmod -R 777 storage
chmod -R 777 bootstrap
chmod -R 777 public/files

php artisan vendor:publish --provider="Intervention\Image\ImageServiceProviderLaravel5"
php artisan vendor:publish
}

echo "Start setup..."

cp .env.stage .env
setup_laravel







