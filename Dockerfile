# --------- Stage 1: build des assets avec Node ----------
FROM node:20 AS assets
WORKDIR /app

# Copie le strict nécessaire pour profiter du cache Docker
COPY package.json package-lock.json* pnpm-lock.yaml* yarn.lock* ./
# Choisis le bon gestionnaire. Par défaut on utilise npm.
RUN npm ci || npm install

# Copie le code nécessaire au build Vite
COPY vite.config.* ./
COPY resources ./resources
COPY public ./public

# Vite a besoin du manifeste Laravel pour mettre le build au bon endroit (public/build)
# Si ton projet référence d'autres fichiers (ex. tailwind.config, postcss.config), copie-les aussi :
COPY tailwind.config.* postcss.config.* ./. 2>/dev/null || true

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
# Vite met le résultat dans /app/public/build
COPY --from=assets /app/public/build ./public/build

# Permissions
RUN chown -R www-data:www-data storage bootstrap/cache database public/build

# Expose port 80
EXPOSE 80

# Démarrage: migrations + seeding (démo) puis Apache
CMD php artisan migrate --force --seed && apache2-foreground
