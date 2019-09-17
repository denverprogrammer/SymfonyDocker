# ./docker/php/Dockerfile
FROM php:7.2-fpm

RUN apt-get update && \
    apt-get install -y \
            zlib1g-dev \
            wget \
            acl && \
    docker-php-ext-install zip \
                           pdo \
                           pdo_mysql && \
    pecl install xdebug && \
    pecl install apcu-5.1.8 && \
    docker-php-ext-enable xdebug && \
    docker-php-ext-enable apcu

WORKDIR /usr/src/app

COPY --from=composer /usr/bin/composer /usr/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_CACHE_DIR=/dev/null

COPY docker/php/ApplicationInstall.sh /usr/local/bin/ApplicationInstall.sh
RUN chmod +x /usr/local/bin/ApplicationInstall.sh

ENTRYPOINT ["/usr/local/bin/ApplicationInstall.sh"]
CMD ["php-fpm"]

RUN PATH=$PATH:/usr/src/app/vendor/bin:bin
