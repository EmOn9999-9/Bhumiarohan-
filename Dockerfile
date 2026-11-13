# Production image for Bhumi Arohan (used by Railway, works on any Docker host).
# Persistent data (SQLite database + uploaded photos) lives in /app/storage, which
# should be mounted as a volume.

# ---- 1. PHP dependencies ----------------------------------------------------
FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist --no-interaction --ignore-platform-reqs
COPY . .
RUN composer dump-autoload --no-dev --optimize --classmap-authoritative --no-scripts

# ---- 2. Front-end assets (Tailwind scans vendor views, so build after step 1) ----
FROM node:22-bookworm-slim AS assets
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci --no-audit --no-fund
COPY --from=vendor /app /app
RUN npm run build

# ---- 3. Runtime: FrankenPHP (PHP 8.4 + built-in web server) ----------------
FROM dunglas/frankenphp:1-php8.4-bookworm
RUN install-php-extensions pdo_sqlite opcache intl zip bcmath

WORKDIR /app
COPY --from=vendor /app /app
COPY --from=assets /app/public/build /app/public/build
RUN cp "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" \
    && printf 'upload_max_filesize=20M\npost_max_size=60M\nmemory_limit=256M\nexpose_php=Off\n' > "$PHP_INI_DIR/conf.d/app.ini" \
    && php artisan package:discover --ansi \
    && chmod +x docker/start.sh

ENV APP_ENV=production \
    APP_DEBUG=false \
    LOG_CHANNEL=stderr \
    DB_CONNECTION=sqlite \
    DB_DATABASE=/app/storage/database/database.sqlite \
    PORT=8080

EXPOSE 8080
CMD ["/app/docker/start.sh"]
