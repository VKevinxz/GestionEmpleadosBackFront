#!/usr/bin/env bash
# exit on error
set -o errexit

# Instalar dependencias de PHP
composer install --no-dev --optimize-autoloader

# Instalar dependencias de Node.js
npm install

# Compilar assets
npm run build

# Ejecutar migraciones
php artisan migrate --force

# Optimizar la aplicación
php artisan config:cache
php artisan route:cache
php artisan view:cache
