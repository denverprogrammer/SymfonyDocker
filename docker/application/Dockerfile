# ./docker/php/Dockerfile
FROM php:7.2-fpm-alpine

RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini && \
    sed -i -e "s/^ *memory_limit.*/memory_limit = 4G/g" /usr/local/etc/php/php.ini

# Copy application to correct place in container
WORKDIR /usr/src/app

# Setup composer for this container.
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_CACHE_DIR=/dev/null
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Setup ApplicationInstall.sh file to run after container build is completed.
COPY build/DatabaseWait.sh /usr/local/bin/DatabaseWait.sh
COPY build/InitialSetup.sh /usr/local/bin/InitialSetup.sh

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
    chmod +x /usr/local/bin/DatabaseWait.sh && \
    chmod +x /usr/local/bin/InitialSetup.sh;

# Install XDebug
RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS && \
    pecl install xdebug && \
    docker-php-ext-enable xdebug && \
    apk del .build-deps
