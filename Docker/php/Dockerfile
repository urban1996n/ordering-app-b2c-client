ARG COMPOSER_MEMORY_LIMIT=-1

FROM php:8.0-fpm-alpine

RUN apk update;
RUN apk upgrade;

# "Ref" for docker-php-ext-install: https://hub.docker.com/r/phpdocker/phpdocker/dockerfile

# mongodb.so (extension is only required by comopser.json ext-mongodb)
RUN apk add --no-cache php8-pear php8-dev gcc musl-dev make
RUN pecl install  mongodb

# MONGODB
RUN docker-php-ext-enable mongodb
# CTYPE
RUN docker-php-ext-install -j$(nproc) ctype \
    && docker-php-ext-enable ctype

# ZIP
RUN apk add libzip-dev \
	&& docker-php-ext-install -j$(nproc) zip \
	&& docker-php-ext-enable zip

# GD
RUN apk add libgd libpng-dev \
	&& docker-php-ext-install -j$(nproc) gd \
	&& docker-php-ext-enable gd

# INTL
RUN apk add icu-dev \
	&& docker-php-ext-configure intl \
	&& docker-php-ext-install -j$(nproc) intl \
	&& docker-php-ext-enable intl

# INSTALL REQUIRED PACKAGES
RUN apk add php-dom \
    php-ctype \
    php-gd \
    php-iconv \
    php-intl \
    php-session \
    php-simplexml \
    php-tokenizer \
    php-xml \
    php-xmlwriter

WORKDIR /var/www/html
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');";
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"