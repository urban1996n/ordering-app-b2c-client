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

# Composer PHP manager
RUN apk add composer