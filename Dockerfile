# Etapa base con PHP 8.2 y FPM
FROM php:8.2-fpm

# Instalar dependencias necesarias
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    zip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo_mysql zip mbstring exif pcntl bcmath

# Instalar Composer (manualmente en la misma etapa)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Establecer el directorio de trabajo dentro del contenedor
WORKDIR /var/www

# Copiar todos los archivos del proyecto al contenedor
COPY . .

# Instalar las dependencias de Laravel (sin las de desarrollo para producción)
RUN composer install --no-dev --no-interaction --optimize-autoloader

# Cambiar permisos
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www

# Puerto expuesto por PHP-FPM (usado por Nginx en el servicio web)
EXPOSE 9000
