#!/bin/bash
set -e

cd /var/www/html

# ── Create .env if missing (needed by key:generate) ───────────
if [ ! -f .env ]; then
    cp .env.example .env 2>/dev/null || touch .env
fi

# ── PHP-FPM socket config ─────────────────────────────────────
mkdir -p /run
cat > /usr/local/etc/php-fpm.d/zz-render.conf <<'EOF'
[www]
listen = /run/php-fpm.sock
listen.owner = www-data
listen.group = www-data
listen.mode = 0660
EOF

# ── APP_KEY ───────────────────────────────────────────────────
if [ -z "$APP_KEY" ] || [[ "$APP_KEY" != base64:* ]]; then
    php artisan key:generate --force
fi

# ── Storage link ──────────────────────────────────────────────
php artisan storage:link 2>/dev/null || true

# ── SQLite database ──────────────────────────────────────────
touch database/database.sqlite
chown -R www-data:www-data database

# ── Migrations + seed ────────────────────────────────────────
php artisan migrate --force --seed 2>/dev/null || php artisan migrate --force

# ── Cache for production ─────────────────────────────────────
php artisan config:cache
php artisan route:cache
php artisan view:cache

# ── Fix permissions ──────────────────────────────────────────
chown -R www-data:www-data storage bootstrap/cache

exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
