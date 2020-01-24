# ./docker/php/Dockerfile
FROM php:7.2-fpm-alpine

# Copy application to correct place in container
WORKDIR /usr/src/app

# Setup composer for this container.
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_CACHE_DIR=/dev/null
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Setup ApplicationInstall.sh file to run after container build is completed.
# COPY docker/application/ApplicationInstall.sh /usr/local/bin/ApplicationInstall.sh
# COPY docker/application/Wait.sh /usr/local/bin/Wait.sh

RUN apk update && \
    apk add --no-cache \
        wget \
        acl && \
    docker-php-ext-install pdo_mysql && \
    # docker-php-ext-install zip pdo_mysql && \
    # docker-php-ext-configure zip --with-libzip=/usr/include && \
    apk add --no-cache --virtual .build-deps $PHPIZE_DEPS \
        libzip-dev && \
        pecl install apcu-5.1.8 && \
        docker-php-ext-enable apcu && \
        apk del .build-deps && \
    PATH=$PATH:/usr/src/app/vendor/bin:bin;

# Install XDebug if needed.
# RUN pecl install xdebug && \
#     docker-php-ext-enable xdebug

# ENTRYPOINT ["/usr/local/bin/ApplicationInstall.sh"]
# CMD ["php-fpm"]
