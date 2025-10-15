#!/usr/bin/env bash#!/usr/bin/env bash

set -eset -e



echo "Verificando entorno..."echo "🧰 Instalando dependencias de Composer..."

php --versioncomposer install --no-dev --optimize-autoloader --working-dir=/var/www/html

composer --version || echo "Composer no disponible"

echo "🔑 Generando clave de aplicación..."

echo "Generando clave de aplicacion..."php artisan key:generate --force

php artisan key:generate --force

echo "🗄️ Verificando base de datos..."

echo "Verificando conexion a base de datos..."php artisan migrate:status || echo "Base de datos no disponible aún"

php artisan migrate:status || echo "Base de datos no disponible aun"

echo "🧭 Ejecutando migraciones..."

echo "Ejecutando migraciones..."php artisan migrate --force

php artisan migrate --force

echo "⚡ Optimizando aplicación..."

echo "Optimizando aplicacion..."php artisan config:cache

php artisan config:cachephp artisan route:cache

php artisan route:cachephp artisan view:cache

php artisan view:cache

echo "� Limpiando cachés antiguos..."

echo "Aplicacion lista!"php artisan optimize:clear || true

echo "Iniciando Nginx + PHP-FPM..."

exec /start.shecho "🚀 Iniciando Nginx + PHP-FPM..."

exec /start.sh
