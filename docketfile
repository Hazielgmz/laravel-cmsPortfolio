# Imagen base con Nginx + PHP-FPM
FROM richarvey/nginx-php-fpm:latest

# Instalar dependencias del sistema y extensiones necesarias
RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Copiar archivos del proyecto
COPY . /var/www/html

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Permisos para Laravel
RUN chown -R nginx:nginx /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

# Script de inicio
COPY deploy.sh /usr/local/bin/deploy.sh
RUN chmod +x /usr/local/bin/deploy.sh

# Exponer puerto
EXPOSE 80

# Comando al iniciar el contenedor
CMD ["/usr/local/bin/deploy.sh"]
