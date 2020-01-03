#!/usr/bin/env bash

set -e

role=${CONTAINER_ROLE:-app}
env=${APP_ENV:-production}

if [ "$env" != "local" ]; then
    echo "Caching configuration"
    php /application/artisan config:cache
    php /application/artisan route:cache
fi

if [ "$role" = "app" ]; then
    /usr/sbin/php-fpm -F -O 2>&1 | sed -u 's,.*: \"\(.*\)$,\1,'| sed -u 's,"$,,' 1>&1
elif [ "$role" = "queue" ]; then
    echo "Running the queue $queue"
    /usr/bin/supervisord --nodaemon -c /etc/supervisor/supervisord.conf
elif [ "$role" = "scheduler" ]; then
    while [ true ]
    do
      php /application/artisan schedule:run --verbose --no-interaction &
      sleep 60
    done
else
    echo "Could not match the container role \"$role\""
    exit 1
fi
