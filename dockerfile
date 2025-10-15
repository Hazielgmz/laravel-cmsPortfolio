FROM richarvey/nginx-php-fpm:3.1.6

# Copiamos el proyecto al webroot estándar de la imagen
COPY . /var/www/html

# Configuración básica para Laravel en producción
ENV WEBROOT=/var/www/html/public \
	RUN_SCRIPTS=1 \
	REAL_IP_HEADER=1 \
	PHP_ERRORS_STDERR=1

# Agregamos un script de arranque para instalar deps y cachear antes de iniciar Nginx/PHP-FPM
COPY deploy.sh /scripts/10-deploy.sh
RUN chmod +x /scripts/10-deploy.sh

# El entrypoint/CMD por defecto de la imagen ya inicia Nginx + PHP-FPM y ejecuta /scripts/* si RUN_SCRIPTS=1
# Exponer el puerto (opcional, la imagen ya expone 80)
EXPOSE 80
