FROM php:7.4-apache

ENV PORT 80
ENV APP_ROOT ''
ENV DATABASE_HOST ''
ENV DATABASE_PORT ''
ENV DATABASE_NAME ''
ENV DATABASE_USERNAME ''
ENV DATABASE_PASSWORD ''

WORKDIR /app

RUN apt-get update && apt-get install -y \
        curl \
        net-tools \
        libonig-dev \
        libzip-dev \
    && docker-php-ext-install -j$(nproc) mbstring mysqli pdo_mysql zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ADD docker/apache2.conf /etc/apache2/apache2.conf
RUN a2enmod rewrite \
    && a2dismod mpm_event \
    && a2enmod mpm_prefork

ADD . /app

RUN composer install
RUN chown -R www-data:www-data .

EXPOSE 80
