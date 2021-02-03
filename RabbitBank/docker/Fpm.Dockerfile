FROM php:7.4.3-fpm 

RUN apt-get update \
&& docker-php-ext-install pdo pdo_mysql

