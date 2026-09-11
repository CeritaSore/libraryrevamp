#!/bin/sh
set -e

PORT="${PORT:-8080}"
export PORT

echo "==> Application booting on port ${PORT} with FrankenPHP..."

# Safeguard: Remove capabilities if present
setcap -r /usr/local/bin/frankenphp 2>/dev/null || true

echo "==> Setting permissions for storage, bootstrap/cache, and Caddy..."
mkdir -p /var/www/html/storage/framework/sessions \
         /var/www/html/storage/framework/views \
         /var/www/html/storage/framework/cache \
         /var/www/html/storage/logs \
         /var/www/html/bootstrap/cache \
         /data/caddy \
         /config/caddy

chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /data /config 2>/dev/null || true
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /data /config 2>/dev/null || true

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
exec frankenphp run --config /etc/caddy/Caddyfile --adapter caddyfile
