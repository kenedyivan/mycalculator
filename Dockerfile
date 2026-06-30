FROM php:8.3-fpm-alpine

WORKDIR /var/www

RUN apk add --no-cache bash curl git unzip libzip-dev oniguruma-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip bcmath opcache

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY composer.json ./
RUN composer config policy.advisories.block false \
    && composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader --no-scripts

COPY . .

RUN mkdir -p storage/logs storage/framework/cache/data storage/framework/sessions storage/framework/views bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache \
    && composer dump-autoload --optimize --no-scripts

USER www-data

EXPOSE 9000
CMD ["php-fpm"]
