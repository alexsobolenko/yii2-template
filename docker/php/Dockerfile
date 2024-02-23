FROM php:8.2-fpm

RUN apt-get update
RUN apt-get install -y zlib1g-dev g++ libicu-dev zip libzip-dev curl libpng-dev libmagickwand-dev
RUN apt-get install -y wget mc libsqlite3-dev build-essential checkinstall libssl-dev

RUN docker-php-ext-install intl
RUN docker-php-ext-install opcache
RUN docker-php-ext-install pdo
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install pdo_sqlite

RUN pecl install apcu
RUN docker-php-ext-enable apcu

RUN docker-php-ext-configure zip
RUN docker-php-ext-install zip

RUN docker-php-ext-configure gd
RUN docker-php-ext-install gd

RUN pecl install imagick
RUN docker-php-ext-enable imagick

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html
