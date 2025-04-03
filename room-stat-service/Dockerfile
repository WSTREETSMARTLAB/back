FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    git \
    curl \
    && docker-php-ext-install zip pdo pdo_mysql \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && pecl install redis  \
    && docker-php-ext-enable redis

WORKDIR /var/www/html

COPY . .

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN chown -R www-data:www-data /var/www/html

RUN composer install

EXPOSE 9010
CMD ["php-fpm"]
