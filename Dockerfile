# --------- Stage 1: build des assets avec Node ----------
FROM node:20 AS assets
WORKDIR /app

# Overrides avant install pour éviter le bug rollup/native
COPY package.json ./
RUN npm pkg set overrides.rollup="^4.20.0" \
 && npm pkg set overrides.esbuild="^0.21.5"

# Si lock présent on le remplace, sinon install standard
COPY package-lock.json* ./
RUN rm -f package-lock.json && npm install --no-audit --no-fund

# Build Vite
COPY . .
RUN npm run build

# --------- Stage 2: PHP + Apache ----------
FROM php:8.2-apache

# Extensions & rewrite
RUN apt-get update && apt-get install -y \
    libonig-dev libzip-dev unzip git curl sqlite3 libsqlite3-dev \
 && docker-php-ext-install pdo pdo_mysql pdo_sqlite mbstring zip bcmath \
 && a2enmod rewrite

# Apache -> /public et AllowOverride
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf \
 && sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/default-ssl.conf || true \
 && printf "<Directory ${APACHE_DOCUMENT_ROOT}>\n\tAllowOverride All\n</Directory>\n" > /etc/apache2/conf-available/laravel.conf \
 && a2enconf laravel \
 && echo "ServerName localhost" > /etc/apache2/conf-available/servername.conf \
 && a2enconf servername

WORKDIR /var/www/html

# Composer en root et chemins Laravel OK
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV VIEW_COMPILED_PATH=/var/www/html/storage/framework/views

# (Optionnel) logs Laravel dans les logs Render
ENV LOG_CHANNEL=stderr
ENV LOG_LEVEL=debug

# IMPORTANT: par défaut au build on force des drivers qui n'utilisent PAS la DB
ENV CACHE_STORE=file
ENV SESSION_DRIVER=file
ENV QUEUE_CONNECTION=sync
ENV MAIL_MAILER=log

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Code
COPY . .

# Dossiers nécessaires avant composer install
RUN mkdir -p storage/framework/{cache,sessions,views} bootstrap/cache \
 && chown -R www-data:www-data storage bootstrap/cache

# (Facultatif) Faker dispo même sans dev deps (utile si un jour tu seedes)
RUN composer require fakerphp/faker:^1.23 --no-interaction --no-progress --no-scripts

# Install PHP deps SANS scripts (évite package:discover qui peut booter l'app)
RUN composer install --no-dev --prefer-dist --optimize-autoloader --no-scripts

# Pas d'artisan ici (pas de DB à ce stade). Juste le lien storage:
RUN php artisan storage:link || true

# Assets compilés
COPY --from=assets /app/public/build ./public/build

# Permissions
RUN chown -R www-data:www-data storage bootstrap/cache database public/build

EXPOSE 80

# --------- Démarrage: migrations SQLite "safe" + colonnes manquantes, PAS de seeding ---------
CMD mkdir -p database && touch database/database.sqlite \
 && sh -lc 'set -e; \
    for f in $(ls database/migrations/*create_*_table.php 2>/dev/null | sort); do \
      echo "→ Migrating $f"; \
      php artisan migrate --force --path="$f" || echo "Skipping $f (SQLite incompat)"; \
    done' \
 && apache2-foreground
