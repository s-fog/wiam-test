FROM composer:latest AS composer
FROM php:8.2-fpm

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN apt-get update
RUN apt-get install -y curl ssh libzip-dev zip libwebp-dev libpng-dev libfreetype6-dev libjpeg62-turbo-dev libavif-dev git libicu-dev
RUN docker-php-ext-install pdo pdo_mysql zip pcntl exif intl
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp --with-avif && docker-php-ext-install gd
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www
USER www

EXPOSE 8000
