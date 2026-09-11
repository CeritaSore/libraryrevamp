#!/bin/sh
set -e

PORT="${PORT:-8080}"
export PORT

echo "==> Application booting on port ${PORT} with FrankenPHP..."

echo "==> Setting permissions for storage and bootstrap/cache..."
mkdir -p /var/www/html/storage/framework/sessions \
         /var/www/html/storage/framework/views \
         /var/www/html/storage/framework/cache \
         /var/www/html/storage/logs \
         /var/www/html/bootstrap/cache

chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Only attempt migrations & schema setup if DB configuration is present
if [ -n "$DATABASE_URL" ] || [ -n "$DB_URL" ] || [ -n "$DB_HOST" ]; then
    echo "==> Ensuring PostgreSQL schema exists..."
    php artisan app:prepare-database --no-interaction || true

    echo "==> Running database migrations..."
    php artisan migrate --force --no-interaction || true
fi

echo "==> Caching application configurations and routes..."
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true
php artisan event:cache || true

echo "==> Starting FrankenPHP application server..."
exec frankenphp run --config /etc/caddy/Caddyfile
