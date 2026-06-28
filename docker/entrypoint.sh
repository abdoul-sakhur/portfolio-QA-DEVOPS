#!/bin/bash
set -e

cd /var/www/html

# ── Create .env if missing (needed by key:generate) ───────────
if [ ! -f .env ]; then
    cp .env.example .env 2>/dev/null || touch .env
fi

# ── Dynamic port (Railway sets $PORT automatically) ───────────
PORT="${PORT:-10000}"
sed -i "s/listen [0-9]*/listen ${PORT}/" /etc/nginx/sites-available/default
echo "Nginx listening on port ${PORT}"

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

# ── SQLite database (only when DB_CONNECTION=sqlite) ─────────
if [ "${DB_CONNECTION:-sqlite}" = "sqlite" ]; then
    DB_PATH="${DB_DATABASE:-/var/www/html/database/database.sqlite}"
    mkdir -p "$(dirname "$DB_PATH")"
    touch "$DB_PATH"
    chown -R www-data:www-data "$(dirname "$DB_PATH")"
fi

# ── Migrations (no auto-seed: avoids duplicating data on every restart) ──
php artisan migrate --force

# ── Cache for production ─────────────────────────────────────
php artisan config:cache
php artisan route:cache
php artisan view:cache

# ── Fix permissions ──────────────────────────────────────────
chown -R www-data:www-data storage bootstrap/cache
chmod -R 755 public/build 2>/dev/null || true

# ── Debug: verify build assets at runtime ────────────────────
echo "=== Runtime: Checking public/build ==="
ls -la public/build/ 2>/dev/null || echo "WARNING: public/build/ NOT FOUND"
ls -la public/build/assets/ 2>/dev/null || echo "WARNING: public/build/assets/ NOT FOUND"
cat public/build/manifest.json 2>/dev/null || echo "WARNING: manifest.json NOT FOUND"
echo "=== Nginx root contents ==="
ls -la public/ | head -20

exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
