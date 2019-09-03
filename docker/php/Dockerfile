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
    pecl install apcu-5.1.8 && \
    docker-php-ext-enable apcu

WORKDIR /usr/src/app

COPY docker/php/ApplicationInstall.sh /usr/local/bin/ApplicationInstall.sh
RUN chmod +x /usr/local/bin/ApplicationInstall.sh

ENTRYPOINT ["/usr/local/bin/ApplicationInstall.sh"]
CMD ["php-fpm"]

RUN PATH=$PATH:/usr/src/app/vendor/bin:bin
