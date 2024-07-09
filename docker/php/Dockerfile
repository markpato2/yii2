FROM php:7.4-fpm

# Instalar extensões PHP necessárias
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git \
    && docker-php-ext-install pdo_mysql zip

# Copiar php.ini customizado
COPY ./docker/php/php.ini /usr/local/etc/php/php.ini

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurações adicionais, se necessário
WORKDIR /var/www/html
