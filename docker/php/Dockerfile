FROM php:8.2-fpm
FROM composer:1.8 AS composer

RUN apt-get update
RUN docker-php-ext-install pdo pdo_mysql mysqli

COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY . .
# RUN composer install
