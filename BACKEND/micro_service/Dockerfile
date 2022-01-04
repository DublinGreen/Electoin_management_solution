FROM php:7.3-fpm-alpine

WORKDIR /var/www/html/

RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

COPY . .

RUN composer install

RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN docker cp db.sql 7942e892f352:/db.sql

