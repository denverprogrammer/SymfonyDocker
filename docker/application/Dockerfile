# ./docker/php/Dockerfile
FROM php:7.2-fpm-alpine

# Memory has to be increased only in dev, testing or staging environments.
RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini && \
    sed -i -e "s/^ *memory_limit.*/memory_limit = 4G/g" /usr/local/etc/php/php.ini

# Set application working directory.
WORKDIR /usr/src/app

# Copy application scripts to run after container is built.
COPY build/ /usr/src/bin/

# Setup composer for this container.
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_CACHE_DIR=/dev/null
COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN apk update && \
    apk add --no-cache \
        wget \
        acl && \
    docker-php-ext-install pdo_mysql && \
    apk add --no-cache --virtual .build-deps $PHPIZE_DEPS \
        libzip-dev && \
    pecl install apcu-5.1.8 && \
    docker-php-ext-enable apcu && \
    apk del .build-deps && \
    PATH=$PATH:/usr/src/app/vendor/bin:bin && \
    mkdir -p /usr/src/app/var/cache && \
    mkdir -p /usr/src/app/var/log && \
    chmod -R 777 /usr/src/app/var/log/;

# Install xDebug
RUN apk add --no-cache \
        rabbitmq-c-dev \
        supervisor && \
    apk add --no-cache --virtual .build-deps $PHPIZE_DEPS && \
    pecl install \
        xdebug \
        amqp && \
    docker-php-ext-enable \
        xdebug \
        amqp && \
    apk del .build-deps && \
    chmod +x -R /usr/src/bin;
