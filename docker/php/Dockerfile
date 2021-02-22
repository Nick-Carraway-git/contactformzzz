FROM php:8.0.2-fpm-alpine3.13

RUN apk --no-cache update && \
    apk --no-cache upgrade && \
    apk --no-cache add \
    oniguruma-dev \
    && docker-php-ext-install pdo_mysql mysqli

COPY ./php.ini /usr/local/etc/php/php.ini

WORKDIR /contactform
