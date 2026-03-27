# ── Stage 1: Build frontend assets ──────────────────────────────
FROM node:18-alpine AS node-builder
WORKDIR /app
COPY package.json package-lock.json* ./
RUN npm ci --silent
COPY resources resources
COPY vite.config.js postcss.config.js tailwind.config.js ./
RUN npm run build

# ── Stage 2: PHP + Nginx + Supervisor (single container for Render) ─
FROM php:8.4-fpm

# Install system deps + nginx + supervisor
RUN apt-get update && apt-get install -y --no-install-recommends \
        git unzip curl \
        nginx supervisor \
        libpng-dev libjpeg62-turbo-dev libfreetype6-dev \
        libonig-dev libxml2-dev libzip-dev libicu-dev \
        zlib1g-dev libsqlite3-dev \
    && docker-php-ext-configure gd --with-jpeg --with-freetype \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite mbstring exif pcntl bcmath gd zip intl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy application code
COPY . .

# Copy built frontend assets (Vite outputs to public/build)
COPY --from=node-builder /app/public/build public/build

# Install PHP deps (production only)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Create SQLite database file
RUN touch database/database.sqlite

# Nginx config – Render exposes port 10000, local test uses same port
COPY docker/nginx/render.conf /etc/nginx/sites-available/default
RUN ln -sf /etc/nginx/sites-available/default /etc/nginx/sites-enabled/default \
    && rm -f /etc/nginx/sites-enabled/default.bak

# Supervisor config
COPY docker/supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Directories & permissions
RUN mkdir -p storage/framework/{sessions,views,cache} \
             storage/logs storage/app/public \
             bootstrap/cache /run \
    && chown -R www-data:www-data storage bootstrap/cache database/database.sqlite

# Entrypoint
COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Render free tier requires port 10000
EXPOSE 10000

ENTRYPOINT ["/entrypoint.sh"]
