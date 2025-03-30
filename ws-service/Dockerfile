FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    && docker-php-ext-install pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY ./ /var/www/html

RUN composer install || true

CMD php index.php
