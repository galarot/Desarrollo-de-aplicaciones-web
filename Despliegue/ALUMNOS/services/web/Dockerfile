FROM php:8.2-apache

# mysqli
RUN docker-php-ext-install -j"$(nproc)" mysqli

WORKDIR /var/www/html
COPY src/ .

