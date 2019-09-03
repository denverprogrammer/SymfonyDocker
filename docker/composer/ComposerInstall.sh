#!/bin/sh
set -e

echo "\n"
echo "###############################################################################"
echo "##  Install composer package manager"
echo "###############################################################################"

# first arg is `-f` or `--some-option`
if [ "${1#-}" != "$1" ]; then
	set -- php-fpm "$@"
fi

EXPECTED_SIGNATURE="$(wget -q -O - https://composer.github.io/installer.sig)"
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
ACTUAL_SIGNATURE="$(php -r "echo hash_file('sha384', 'composer-setup.php');")"

if [ "$EXPECTED_SIGNATURE" != "$ACTUAL_SIGNATURE" ]
then
	>&2 echo 'ERROR: Invalid installer signature'
	rm composer-setup.php
	exit 1
fi

php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RESULT=$?
rm composer-setup.php

echo "\n"
echo "###############################################################################"
echo "##  Install application dependencies"
echo "###############################################################################"

composer install --prefer-dist --no-progress --no-suggest; \
composer clear-cache

exec docker-php-entrypoint "$@"
