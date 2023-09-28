FROM php:8.2-cli-alpine

RUN docker-php-ext-install bcmath

RUN curl -sS https://getcomposer.org/installer | php -- \
        --filename=composer \
        --install-dir=/usr/local/bin \
        --version=2.6.3