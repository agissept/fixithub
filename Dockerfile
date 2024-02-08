FROM node:18 AS BuildStageFrontend

WORKDIR /app

COPY . .

RUN npm install
RUN npm run build

FROM composer:2.6 AS BuildStageBackend

WORKDIR /app

COPY --from=BuildStageFrontend /app/ /app

RUN composer install --optimize-autoloader --no-dev
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

FROM php:8.2-fpm

RUN apt-get update -y && apt-get install -y --no-install-recommends \
        apt-utils curl  libbz2-dev  gcc  autoconf \
        libc6-dev libfreetype6-dev libjpeg62-turbo-dev \
        libpng-dev libicu-dev zlib1g-dev libzip-dev \
        pkg-config libmcrypt-dev iputils-ping  && \
        apt-get clean -y

RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql
# install php module
RUN docker-php-ext-install bcmath
RUN docker-php-ext-install bz2
RUN docker-php-ext-configure gd; \
    docker-php-ext-install -j$(nproc)  gd
RUN docker-php-ext-configure intl; \
    docker-php-ext-install intl
RUN docker-php-ext-install mysqli
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install pcntl

COPY --from=BuildStageBackend /app/ /app
