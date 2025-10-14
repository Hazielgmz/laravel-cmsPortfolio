#!/usr/bin/env bash
echo "🧰 Instalando dependencias de Composer..."
composer install --no-dev --working-dir=/var/www/html

echo "🔑 Generando clave de aplicación..."
php artisan key:generate

echo "⚡ Cacheando configuración..."
php artisan config:cache
php artisan route:cache

echo "🧭 Ejecutando migraciones..."
php artisan migrate --force

echo "🚀 Iniciando Nginx + PHP-FPM..."
/start.sh
