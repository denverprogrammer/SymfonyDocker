#!/bin/sh
set -e

until bin/console doctrine:query:sql "SELECT 1" > /dev/null 2>&1; do
    echo "####  Waiting for database service to be fully functional"
    sleep 1
done

exit $?
