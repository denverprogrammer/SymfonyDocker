# ./docker/php/Dockerfile
FROM rabbitmq:3-management-alpine

RUN mkdir -p /etc/rabbitmq && \
    mkdir -p /var/lib/logs && \
    mkdir -p /var/log/etc;

VOLUME etc /etc/rabbitmq/
VOLUME data /var/lib/rabbitmq/
VOLUME logs /var/log/rabbitmq/
