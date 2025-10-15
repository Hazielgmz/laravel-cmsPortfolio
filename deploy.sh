#!/bin/sh

# Script de arranque para richarvey/nginx-php-fpm
# Se ejecuta antes de iniciar Nginx/PHP-FPM cuando RUN_SCRIPTS=1

set -eu

cd /var/www/html

echo "🧰 Instalando dependencias de Composer (prod)..."
composer install --no-dev --optimize-autoloader || {
	echo "Composer install falló (continuando): $?.";
}

echo "🔑 Asegurando APP_KEY..."
# No generes clave si ya existe
if ! php -r "require 'vendor/autoload.php'; echo (string) (parse_ini_file('.env', false, INI_SCANNER_RAW)['APP_KEY'] ?? '');" | grep -qE "^base64:"; then
	php artisan key:generate --force || true
fi

echo "🗄️ Verificando conexión a base de datos..."
php artisan migrate:status || echo "DB no disponible todavía"

echo "🧭 Ejecutando migraciones (si hay)..."
php artisan migrate --force || echo "Migraciones fallaron, se continúa."

echo "⚡ Cacheando configuración y rutas..."
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

echo "🧹 Limpieza de cachés antiguos..."
php artisan optimize:clear || true

echo "✅ Pre-arranque completado."
