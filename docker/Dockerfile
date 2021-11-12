FROM php:7.4.1-apache

USER root

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
        libpng-dev \
        zlib1g-dev \
        libxml2-dev \
        libzip-dev \
        libonig-dev \
        libpq-dev \
        zip \
        curl \
        unzip \
        nano \
        git \
    && docker-php-ext-configure gd \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo pdo_pgsql \
    && docker-php-ext-install zip \
    && docker-php-source delete

COPY ./docker/default.conf /etc/apache2/sites-available/000-default.conf

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini && \
        sed -i -e "s/^ *memory_limit.*/memory_limit = 4G/g" /usr/local/etc/php/php.ini

RUN chown -R www-data:www-data /var/www/html \
    && a2enmod rewrite
