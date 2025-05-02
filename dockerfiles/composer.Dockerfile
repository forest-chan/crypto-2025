FROM composer:2.7

WORKDIR /var/www/html

RUN docker-php-ext-install bcmath
CMD bash -c "composer install"
