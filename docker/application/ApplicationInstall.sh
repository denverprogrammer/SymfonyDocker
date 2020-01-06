#!/bin/sh
set -e

# first arg is `-f` or `--some-option`
if [ "${1#-}" != "$1" ]; then
	set -- php-fpm "$@"
fi

mkdir -p var/cache var/log

setfacl -R -m u:www-data:rwX -m u:"$(whoami)":rwX var
setfacl -dR -m u:www-data:rwX -m u:"$(whoami)":rwX var

if [ "$APP_ENV" != 'prod' ]; then

	echo "###############################################################################"
	echo "##  Set Security keys if needed"
	echo "###############################################################################"

	jwt_passphrase=$(grep '^JWT_PASSPHRASE=' /usr/src/app/.env | cut -f 2 -d '=')
	if [ ! -f config/jwt/private.pem ] || ! echo "$jwt_passphrase" | openssl pkey -in config/jwt/private.pem -passin stdin -noout > /dev/null 2>&1; then
		echo "Generating public / private keys for JWT"
		mkdir -p config/jwt
		echo "$jwt_passphrase" | openssl genpkey -out config/jwt/private.pem -pass stdin -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
		echo "$jwt_passphrase" | openssl pkey -in config/jwt/private.pem -passin stdin -out config/jwt/public.pem -pubout
		setfacl -R -m u:www-data:rX -m u:"$(whoami)":rwX config/jwt
		setfacl -dR -m u:www-data:rX -m u:"$(whoami)":rwX config/jwt
	fi

	echo "###############################################################################"
	echo "##  Install application dependencies using composer"
	echo "###############################################################################"

	composer install --prefer-dist --no-suggest

	until bin/console doctrine:query:sql "SELECT 1" > /dev/null 2>&1; do
		echo "####  Waiting for database service to be fully functional"
		sleep 1
	done

	echo "###############################################################################"
	echo "##  Database service functional running migrations"
	echo "###############################################################################"
	bin/console doctrine:migrations:migrate --no-interaction --query-time --all-or-nothing
fi

echo "###############################################################################"
echo "##  Application install completed"
echo "###############################################################################"

exec docker-php-entrypoint "$@"
