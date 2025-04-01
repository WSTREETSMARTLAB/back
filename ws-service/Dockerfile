FROM php:8.2-cli

# Установка зависимостей
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo pdo_mysql \
    && pecl install xdebug \

# Копируем Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Устанавливаем рабочую директорию
WORKDIR /var/www/html

# Копируем все файлы проекта
COPY . .

# Устанавливаем зависимости
RUN composer install --no-interaction --prefer-dist --optimize-autoloader || true

# Экспонируем порт (если нужно общение через порт, иначе можно убрать)
EXPOSE 8081

# Точка входа
CMD ["php", "public/server.php"]
