#!/bin/sh
# Container start-up: prepare persistent storage, migrate, seed (first run only), serve.
set -e
cd /app

# storage/ is a mounted volume in production and starts empty on the first deploy.
mkdir -p storage/app/public \
         storage/framework/cache/data storage/framework/sessions storage/framework/views \
         storage/logs \
         "$(dirname "$DB_DATABASE")"
[ -f "$DB_DATABASE" ] || touch "$DB_DATABASE"

if [ -z "$APP_KEY" ]; then
    echo "ERROR: APP_KEY is not set. Generate one with 'php artisan key:generate --show' and add it to the environment." >&2
    exit 1
fi

php artisan storage:link --force
php artisan migrate --force
php artisan db:seed --force       # only creates content when the database is empty
php artisan optimize

exec frankenphp php-server --listen ":${PORT:-8080}" --root public/
