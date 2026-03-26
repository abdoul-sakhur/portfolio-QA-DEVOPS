#!/bin/bash
set -e

cd /var/www/html

# Configure PHP-FPM to use a Unix socket
echo "[www]
listen = /run/php-fpm.sock
listen.owner = www-data
listen.group = www-data
listen.mode = 0660" > /usr/local/etc/php-fpm.d/zz-render.conf

# Generate APP_KEY if not set or not in correct format
if [ -z "$APP_KEY" ] || [[ "$APP_KEY" != base64:* ]]; then
    php artisan key:generate --force
fi

# Create storage link if not exists
php artisan storage:link 2>/dev/null || true

# Run migrations + seed on first deploy
php artisan migrate --force --seed 2>/dev/null || php artisan migrate --force

# Cache config / routes / views for performance
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Fix permissions
chown -R www-data:www-data storage bootstrap/cache database/database.sqlite 2>/dev/null || true

exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
