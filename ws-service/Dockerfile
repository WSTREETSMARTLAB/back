FROM php:8.2-cli

# Установка зависимостей
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo pdo_mysql \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

# Копируем Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Устанавливаем рабочую директорию
WORKDIR /var/www/html

# Копируем все файлы проекта
COPY . .

# Установка зависимостей
RUN composer install --no-interaction --prefer-dist --optimize-autoloader || true

# Порт, если тебе нужно подключаться извне
EXPOSE 8081

# Запуск WebSocket сервера
CMD ["php", "public/server.php"]
