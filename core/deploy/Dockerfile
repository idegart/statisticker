FROM php:8.2-fpm-alpine as builder-prod

FROM php:8.2-alpine as builder-dev

FROM builder-prod as prod

COPY ./deploy/www.conf /usr/local/etc/php-fpm.d/www.conf

WORKDIR /var/www/core

FROM builder-dev as dev

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/core

EXPOSE 8000

CMD php -S 0.0.0.0:8000 -t /var/www/core/public
