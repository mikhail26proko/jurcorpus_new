ARG PHP_VERSION=8.1
ARG NODE_VERSION=16.16

# Composer: install vendors
FROM composer:latest AS COMPOSER
    WORKDIR /app
    COPY /backend/composer.json /app/
    RUN composer install

# Node: for install node_modules
FROM node:16.16-alpine AS NODE
    WORKDIR /app
    COPY frontend /app/
    RUN apk add yarn && yarn install

# PHP: main container
FROM php:8.1-fpm-alpine AS PHP
    ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
    RUN chmod +x /usr/local/bin/install-php-extensions && \
        install-php-extensions zip \
        pgsql \
        pdo_pgsql

    # RUN mkdir -p /rub/nginx/ && touch /run/nginx/nginx.pid \
    RUN mkdir -p /var/lib/nginx/tmp /var/log/nginx /var/cache/nginx \
        && chown -R 1000:1000 /var/lib/nginx /var/log/nginx /var/cache/nginx \
        #/run/nginx/nginx.pid 
        && chmod -R 755 /var/lib/nginx /var/log/nginx /var/cache/nginx
        #/run/nginx/nginx.pid 

    ADD ./docker/php/php.ini \
        /etc/php8.1/php.ini
    ADD ./docker/nginx/config/production.conf \ 
        /etc/nginx/nginx.conf
    ADD ./docker/supervisor/supervisor.conf \
        /etc/supervisor.conf

    RUN apk add --no-cache\
        supervisor \
        nginx \
        yarn

    # RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    #     && php composer-setup.php \
    #     && mv composer.phar /usr/bin/composer

    WORKDIR /var/www

    COPY /backend/ /
    COPY --from=NODE /app /
    COPY --from=COMPOSER /app/vendor /

    # COPY --from=NODE /usr/local/lib/node_modules /usr/local/lib/node_modules
    # COPY --from=NODE /usr/local/bin/node /usr/local/bin/node

    # RUN ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm

    EXPOSE 80
    CMD ["supervisord", "-c", "/etc/supervisor.conf"]