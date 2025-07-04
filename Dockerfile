FROM php:8.2-fpm

# Instala dependencias necesarias del sistema y extensiones PHP
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    zip unzip curl git nano libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd

# Instala Composer manualmente
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

# Establece directorio de trabajo
WORKDIR /var/www

# Copia archivos del proyecto
COPY . .

# Da permisos adecuados a la carpeta del proyecto
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www

# Instala las dependencias PHP definidas en composer.json
RUN composer install

EXPOSE 9000
CMD ["php-fpm"]
