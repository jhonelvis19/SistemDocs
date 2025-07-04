FROM composer:2 as composer

FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    curl \
    git \
    && docker-php-ext-install pdo pdo_mysql zip \
    && a2enmod rewrite

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY ./back /var/www/html

RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

RUN composer install --no-interaction --prefer-dist --optimize-autoloader

EXPOSE 80
