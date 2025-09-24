# --------- Stage 1: build des assets avec Node ----------
FROM node:20 AS assets
WORKDIR /app

# (1) Copie uniquement les manifests pour maximiser le cache
COPY package.json package-lock.json* pnpm-lock.yaml* yarn.lock* ./
RUN npm ci || npm install

# (2) Copie tout le code (on filtrera via .dockerignore)
COPY . .

# Build des assets (génère public/build)
RUN npm run build

# --------- Stage 2: image PHP + Apache ----------
FROM php:8.2-apache

# Paquets système & extensions PHP nécessaires à Laravel + SQLite
RUN apt-get update && apt-get install -y \
    libonig-dev libzip-dev unzip git curl sqlite3 libsqlite3-dev \
  && docker-php-ext-install pdo pdo_mysql pdo_sqlite mbstring zip bcmath \
  && a2enmod rewrite

WORKDIR /var/www/html

# Installer Composer (depuis l'image officielle)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copier l'app Laravel
COPY . .

# Installer dépendances PHP (prod)
RUN composer install --no-dev --prefer-dist --optimize-autoloader

# Créer base SQLite + liens storage
RUN mkdir -p database && touch database/database.sqlite && php artisan storage:link || true

# Copier le build Vite depuis le stage Node
COPY --from=assets /app/public/build ./public/build

# Permissions
RUN chown -R www-data:www-data storage bootstrap/cache database public/build

EXPOSE 80

# Démarrage: migrations + seeding (démo) puis Apache
CMD php artisan migrate --force --seed && apache2-foreground
