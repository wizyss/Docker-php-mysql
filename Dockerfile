FROM php:8.2-apache
RUN apt-get update && docker-php-ext-install pdo_mysql
COPY . /var/www/html/
WORKDIR /var/www/html/
EXPOSE 80

