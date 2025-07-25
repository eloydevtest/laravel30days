FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip libzip-dev libicu-dev \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd intl

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN composer global require laravel/installer

RUN git config --global --add safe.directory /var/www


# Instalar Node.js
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

ENV PATH="$PATH:/root/.composer/vendor/bin"

WORKDIR /var/www
