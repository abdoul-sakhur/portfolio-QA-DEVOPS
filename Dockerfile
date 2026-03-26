# ── Build stage: install JS deps and compile assets ──
FROM node:20-alpine AS node-build
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci
COPY vite.config.js tailwind.config.js postcss.config.js ./
COPY resources/ resources/
RUN npm run build

# ── Production image: PHP 8.2 + Nginx in one container ──
FROM php:8.2-fpm-bookworm

# System deps
RUN apt-get update && apt-get install -y --no-install-recommends \
    nginx \
    supervisor \
    git \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libsqlite3-dev \
    zip \
    curl \
    && docker-php-ext-install pdo_mysql pdo_sqlite mbstring exif pcntl bcmath xml gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy app source
COPY . /var/www/html

# Copy built assets from node stage
COPY --from=node-build /app/public/build /var/www/html/public/build

# Install PHP deps (no dev)
RUN composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

# Nginx config
COPY docker/nginx/render.conf /etc/nginx/sites-available/default

# Supervisor config (runs nginx + php-fpm together)
COPY docker/supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Entrypoint script
COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Create SQLite database file
RUN mkdir -p /var/www/html/database && touch /var/www/html/database/database.sqlite \
    && chown www-data:www-data /var/www/html/database/database.sqlite

# Render uses $PORT (default 10000)
EXPOSE 10000

ENTRYPOINT ["/entrypoint.sh"]
