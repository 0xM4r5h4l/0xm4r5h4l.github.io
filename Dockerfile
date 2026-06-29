# syntax=docker/dockerfile:1

#######################################
# Stage 1 — PHP dependencies (Composer)
#######################################
FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --no-scripts \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader \
    --ignore-platform-reqs

#######################################
# Stage 2 — Frontend build (Vite/Tailwind/Alpine)
#######################################
FROM node:20-alpine AS assets
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci
COPY . .
RUN npm run build

#######################################
# Stage 3 — Runtime image
#######################################
FROM php:8.4-fpm-alpine AS runtime

# System deps + PHP extensions Laravel actually needs.
# Build-only -dev packages are removed at the end to keep the final layer lightweight.
RUN apk add --no-cache \
        nginx \
        supervisor \
        gettext \
        libzip \
        libpng \
        libjpeg-turbo \
        freetype \
        icu-libs \
        oniguruma \
    && apk add --no-cache --virtual .build-deps \
        libzip-dev \
        libpng-dev \
        libjpeg-turbo-dev \
        freetype-dev \
        icu-dev \
        oniguruma-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" \
        pdo_mysql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip \
        intl \
        opcache \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apk del .build-deps \
    && rm -rf /var/cache/apk/*

WORKDIR /var/www/html

# App code first (see .dockerignore — vendor/, node_modules/, public/build/, .env are excluded)
COPY --chown=www-data:www-data . .

# Pull built artifacts from the earlier stages
COPY --from=vendor  --chown=www-data:www-data /app/vendor       ./vendor
COPY --from=assets  --chown=www-data:www-data /app/public/build ./public/build

# Runtime config
COPY docker/php.production.ini    /usr/local/etc/php/conf.d/zz-production.ini
COPY docker/nginx.conf.template   /etc/nginx/http.d/default.conf.template
COPY docker/supervisord.conf      /etc/supervisor/conf.d/supervisord.conf
COPY docker/entrypoint.sh         /entrypoint.sh

RUN chmod +x /entrypoint.sh \
    && mkdir -p /run/nginx \
    && chown -R www-data:www-data storage bootstrap/cache

# Informational only — Render assigns the real port via $PORT at runtime
EXPOSE 10000

ENTRYPOINT ["/entrypoint.sh"]