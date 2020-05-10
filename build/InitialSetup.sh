#!/bin/sh
set -e

JWT_SECRET_KEY=/usr/src/app/config/jwt/private.pem
JWT_PUBLIC_KEY=/usr/src/app/config/jwt/public.pem
echo "${JWT_PASSPHRASE} passphrase."
echo "${JWT_SECRET_KEY} JWT_SECRET_KEY."
echo "${JWT_PUBLIC_KEY} JWT_PUBLIC_KEY."

echo 
echo "Setup applications folders"
mkdir -p /usr/src/app/var/cache
mkdir -p /usr/src/app/var/log
mkdir -p /usr/src/app/config/jwt

echo "Generating genpkey for JWT"
echo $JWT_PASSPHRASE | openssl genpkey -out $JWT_SECRET_KEY -pass stdin -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
echo "Generating pkey for JWT"
echo $JWT_PASSPHRASE | openssl pkey -in $JWT_SECRET_KEY -passin stdin -out $JWT_PUBLIC_KEY -pubout

chmod -R 644 /usr/src/app/config/jwt/*

echo "========================================================== current dir"
ls -lac /usr/src/app
echo "========================================================== jwt dir"
ls -lac /usr/src/app/config/jwt

exit $?
