FROM php:8.4.4-apache-bullseye AS www_dev

RUN a2enmod rewrite \
    && docker-php-ext-install pdo pdo_mysql \
#    && pecl install xdebug \
#    && docker-php-ext-enable xdebug