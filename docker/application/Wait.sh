#!/bin/sh
set -e

# first arg is `-f` or `--some-option`
if [ "${1#-}" != "$1" ]; then
	set -- php-fpm "$@"
fi

until bin/console doctrine:query:sql "SELECT 1" > /dev/null 2>&1; do
	echo "####  Waiting for database"
	sleep 1
done

exec "$@"
