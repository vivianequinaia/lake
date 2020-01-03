FROM composer AS builder

ARG COMPOSER_ARGS="-o --no-dev --ignore-platform-reqs --no-scripts"

COPY . /application
WORKDIR /application

RUN rm -rf /application/.git \
    && cp -f /application/.env.dist /application/.env \
    && composer install --ignore-platform-reqs $COMPOSER_ARGS

FROM arquivei/php:php7.2-kafka

RUN apt-get update \
    && apt-get -y install supervisor \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

WORKDIR "/application/"

RUN echo "extension=rdkafka.so" > /etc/php/7.2/php-fpm/conf.d/kafka.ini

COPY docker/php-fpm/config/override.conf /etc/php/7.2/etc/php-fpm.d/z-overrides.conf
COPY docker/php-fpm/php-ini-overrides.ini  /usr/local/etc/php/conf.d/99-overrides.ini

COPY docker/php-fpm/entrypoint.sh /mcd-soda-worker-entrypoint
COPY docker/php-fpm/supervisor/worker.conf /etc/supervisor/conf.d/worker.conf

COPY --from=builder /application /application

WORKDIR /application

ENTRYPOINT /mcd-soda-worker-entrypoint
