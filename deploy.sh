
#!/bin/sh

set -e

echo "🔑 Generando clave de aplicación..."
php artisan key:generate --force || true

echo "🗄️ Verificando base de datos..."
php artisan migrate:status || echo "Base de datos no disponible aún"

echo "🧭 Ejecutando migraciones..."
php artisan migrate --force || echo "Migraciones fallaron, continuando..."

echo "⚡ Optimizando aplicación..."
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

echo "🧹 Limpiando cachés antiguos..."
php artisan optimize:clear || true

echo "🚀 Iniciando servicios con Supervisor..."
exec /usr/bin/supervisord -c /etc/supervisor.d/supervisord.ini



set -e



echo "🔑 Generando clave de aplicación..."set -eset -eset -e

php artisan key:generate --force || true



echo "🗄️ Verificando base de datos..."

php artisan migrate:status || echo "Base de datos no disponible aún"echo "🧰 Instalando dependencias de Composer..."



echo "🧭 Ejecutando migraciones..."composer install --no-dev --optimize-autoloader --working-dir=/var/www/html

php artisan migrate --force || echo "Migraciones fallaron, continuando..."

echo "Verificando entorno..."echo "🧰 Instalando dependencias de Composer..."

echo "⚡ Optimizando aplicación..."

php artisan config:cache || trueecho "🔑 Generando clave de aplicación..."

php artisan route:cache || true

php artisan view:cache || truephp artisan key:generate --forcephp --versioncomposer install --no-dev --optimize-autoloader --working-dir=/var/www/html



echo "🧹 Limpiando cachés antiguos..."

php artisan optimize:clear || true

echo "🗄️ Verificando base de datos..."composer --version || echo "Composer no disponible"

echo "🚀 Iniciando servicios con Supervisor..."

exec /usr/bin/supervisord -c /etc/supervisord.confphp artisan migrate:status || echo "Base de datos no disponible aún"


echo "🔑 Generando clave de aplicación..."

echo "🧭 Ejecutando migraciones..."

php artisan migrate --forceecho "Generando clave de aplicacion..."php artisan key:generate --force



echo "⚡ Optimizando aplicación..."php artisan key:generate --force

php artisan config:cache

php artisan route:cacheecho "🗄️ Verificando base de datos..."

php artisan view:cache

echo "Verificando conexion a base de datos..."php artisan migrate:status || echo "Base de datos no disponible aún"

echo "🧹 Limpiando cachés antiguos..."

php artisan optimize:clear || truephp artisan migrate:status || echo "Base de datos no disponible aun"



echo "🚀 Iniciando Nginx + PHP-FPM..."echo "🧭 Ejecutando migraciones..."

exec /start.sh

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
