FROM php:8.2-fpm-alpine

RUN apk update && apk upgrade && \
    apk add --no-cache \
        postgresql-dev libzip-dev libpng-dev libjpeg-turbo-dev \
        freetype-dev oniguruma-dev icu-dev $PHPIZE_DEPS \
        autoconf dpkg-dev dpkg file g++ gcc libc-dev make pkgconf re2c \
        linux-headers && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install pdo pdo_pgsql pgsql gd zip bcmath intl mbstring && \
    pecl install xdebug && \
    docker-php-ext-enable xdebug && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    apk add --no-cache nginx && \
    rm -rf /var/cache/apk/*

COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf

COPY docker/php/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

COPY app /var/www/html

WORKDIR /var/www/html

RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data /var/www/html

EXPOSE 9000

CMD ["php-fpm"]