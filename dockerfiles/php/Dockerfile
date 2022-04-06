FROM php:5.6-fpm-alpine

WORKDIR /var/www/html

COPY . .

RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN docker-php-ext-enable mysqli pdo_mysql

RUN curl -s https://getcomposer.org/installer | php
# RUN alias composer='php composer.phar'
RUN php composer.phar install --ignore-platform-reqs

