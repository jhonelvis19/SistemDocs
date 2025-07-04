FROM php:8.2-fpm

# Instalar dependencias necesarias del sistema
RUN apt-get update && apt-get install -y \
    unzip \
    curl \
    git \
    zip \
    nano \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd

# Instalar Composer desde la fuente oficial
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Verifica la instalación de Composer
RUN composer --version

# Establece directorio de trabajo
WORKDIR /var/www

# Copia todos los archivos del proyecto
COPY . .

# Establece permisos correctos
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www

# Instala dependencias de PHP/Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

EXPOSE 9000
CMD ["php-fpm"]
