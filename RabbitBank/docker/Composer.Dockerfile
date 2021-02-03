FROM php:7.4.3-fpm

RUN apt-get update 
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer