# ./docker/php/Dockerfile
FROM php:7.2-fpm

RUN apt-get update && \
    apt-get install -y \
            zlib1g-dev \
            wget \
            git \
            zip \
            unzip

ENV COMPOSER_ALLOW_SUPERUSER=1

WORKDIR /usr/src/app

COPY docker/composer/ComposerInstall.sh /usr/local/bin/ComposerInstall.sh
RUN chmod +x /usr/local/bin/ComposerInstall.sh

ENTRYPOINT ["/usr/local/bin/ComposerInstall.sh"]
CMD ["php-fpm"]

RUN PATH=$PATH:/usr/src/app/vendor/bin:bin
