# ./docker/backend/Dockerfile
FROM php:7.4-fpm-alpine

# Set backend working directory.
WORKDIR /usr/src/backend

# Setup composer for this container.
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_CACHE_DIR=/dev/null
COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN apk update && \
    apk add --no-cache \
        curl \
        acl && \
    docker-php-ext-install pdo_mysql && \
    apk add --no-cache --virtual .build-deps $PHPIZE_DEPS \
        libzip-dev && \
    pecl install apcu && \
    docker-php-ext-enable apcu && \
    apk del .build-deps && \
    PATH=$PATH:/usr/src/backend/vendor/bin:bin && \
    mkdir -p /usr/src/backend/var/cache && \
    mkdir -p /usr/src/backend/var/log && \
    chmod -R 777 /usr/src/backend/var/log/;

# # Install dev/test environment
RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini && \
    apk add --no-cache \
        rabbitmq-c-dev \
        supervisor && \
    apk add --no-cache --virtual .build-deps $PHPIZE_DEPS && \
    pecl install \
        xdebug \
        amqp && \
    docker-php-ext-enable \
        xdebug \
        amqp && \
    apk del .build-deps;
