# Usar imagen oficial de PHP 8.2 con FPM
FROM php:8.2-fpm-alpine

# Instalar Nginx y dependencias del sistema
RUN apk add --no-cache \
    nginx \
    zip \
    unzip \
    postgresql-dev \
    libzip-dev \
    oniguruma-dev \
    libxml2-dev \
    curl \
    supervisor

# Instalar extensiones de PHP
# Nota: session, fileinfo, tokenizer ya vienen incluidos en PHP 8.2
RUN docker-php-ext-install \
    pdo \
    pdo_pgsql \
    dom \
    xml \
    zip \
    mbstring

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar archivos del proyecto
COPY . /var/www/html

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Instalar dependencias de Composer durante el build
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# Crear directorios necesarios
RUN mkdir -p /var/www/html/storage/logs \
    && mkdir -p /var/www/html/bootstrap/cache

# Establecer permisos correctos para toda la aplicación
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Configurar Nginx
RUN rm -rf /etc/nginx/http.d/default.conf
COPY <<EOF /etc/nginx/http.d/default.conf
server {
    listen 80;
    server_name _;
    root /var/www/html/public;
    
    index index.php index.html;
    
    # Configurar el usuario de nginx
    charset utf-8;
    
    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }
    
    location ~ \.php$ {
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME \$document_root\$fastcgi_script_name;
        include fastcgi_params;
    }
    
    location ~ /\.(?!well-known).* {
        deny all;
    }
}
EOF

# Configurar nginx para usar el usuario www-data
RUN sed -i 's/user nginx;/user www-data;/g' /etc/nginx/nginx.conf || echo "user www-data;" > /etc/nginx/nginx.conf.tmp && cat /etc/nginx/nginx.conf >> /etc/nginx/nginx.conf.tmp && mv /etc/nginx/nginx.conf.tmp /etc/nginx/nginx.conf

# Configurar Supervisor para ejecutar Nginx y PHP-FPM
RUN mkdir -p /etc/supervisor.d
COPY <<EOF /etc/supervisor.d/supervisord.ini
[supervisord]
nodaemon=true
user=root
logfile=/var/log/supervisord.log
pidfile=/var/run/supervisord.pid

[program:php-fpm]
command=php-fpm -F
stdout_logfile=/dev/stdout
stdout_logfile_maxbytes=0
stderr_logfile=/dev/stderr
stderr_logfile_maxbytes=0
autorestart=false
startretries=0

[program:nginx]
command=nginx -g 'daemon off;'
stdout_logfile=/dev/stdout
stdout_logfile_maxbytes=0
stderr_logfile=/dev/stderr
stderr_logfile_maxbytes=0
autorestart=false
startretries=0
EOF

# Script de inicio
COPY deploy.sh /usr/local/bin/deploy.sh
RUN chmod +x /usr/local/bin/deploy.sh

# Exponer puerto
EXPOSE 80

# Comando al iniciar el contenedor
CMD ["/usr/local/bin/deploy.sh"]
