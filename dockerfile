# Usar imagen base más confiable
FROM richarvey/nginx-php-fpm:3.1.6

# Copiar archivos del proyecto
COPY . /var/www/html

# Configurar variables de imagen
ENV SKIP_COMPOSER=0
ENV WEBROOT=/var/www/html/public
ENV PHP_ERRORS_STDERR=1
ENV RUN_SCRIPTS=1
ENV REAL_IP_HEADER=1

# Script de inicio personalizado
COPY deploy.sh /scripts/run.sh
RUN chmod +x /scripts/run.sh

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
