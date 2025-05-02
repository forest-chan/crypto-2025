FROM php:8.3-alpine

WORKDIR /var/www/html

RUN chown -R www-data:www-data /var/www/html/.*
RUN docker-php-ext-install bcmath
