FROM php:8.2-cli-alpine

RUN apk update && apk upgrade && \
    apk add --no-cache \
        postgresql-dev \
        postgresql-client \
        $PHPIZE_DEPS && \
    docker-php-ext-install pdo pdo_pgsql && \
    rm -rf /var/cache/apk/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

COPY docker/cron/crontab /etc/crontabs/root

RUN chmod 0644 /etc/crontabs/root

RUN touch /var/log/cron.log

CMD crond && tail -f /var/log/cron.log