#!/bin/sh
set -e

# Setup the all transports (Doctrine, RabbitMQ).
/usr/src/app/bin/console messenger:setup-transports --no-interaction

# Start message queue manager (Supervisor).
supervisord --configuration /etc/supervisor/*.conf

exit $?
