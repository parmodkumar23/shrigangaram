FROM php:8.2-apache

# System dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libssl-dev

# MongoDB PHP extension
RUN pecl install mongodb && docker-php-ext-enable mongodb

# Enable Apache rewrite
RUN a2enmod rewrite

# Copy project files
COPY . /var/www/html/
