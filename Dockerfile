FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    git unzip libssl-dev \
    build-essential pkg-config

RUN pecl install mongodb && docker-php-ext-enable mongodb

RUN a2enmod rewrite

# Composer install
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy project
COPY . /var/www/html/

# Generate vendor/autoload.php
RUN composer install --no-dev --optimize-autoloader
