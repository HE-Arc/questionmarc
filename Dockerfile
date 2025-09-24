# --------- Stage 1: build des assets avec Node ----------
FROM node:20 AS assets
WORKDIR /app

# 1) Copier package.json (pas le lock tout de suite)
COPY package.json ./

# 2) Poser les overrides AVANT l'install
RUN npm pkg set overrides.rollup="^4.20.0" \
 && npm pkg set overrides.esbuild="^0.21.5"

# 3) Si ton repo a un package-lock.json, on le régénère avec les overrides
#    -> on ne copie le lock qu'après avoir posé les overrides,
#    -> puis on l'ignore en le remplaçant (pour être sûr que rollup passe en v4)
COPY package-lock.json* ./
RUN rm -f package-lock.json && npm install --no-audit --no-fund

# 4) Copier le reste du code et builder
COPY . .
RUN npm run build

# --------- Stage 2: image PHP + Apache ----------
FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libonig-dev libzip-dev unzip git curl sqlite3 libsqlite3-dev \
  && docker-php-ext-install pdo pdo_mysql pdo_sqlite mbstring zip bcmath \
  && a2enmod rewrite

# Serve Laravel depuis /public et activer .htaccess
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf \
 && sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/default-ssl.conf || true \
 && printf "<Directory ${APACHE_DOCUMENT_ROOT}>\n\tAllowOverride All\n</Directory>\n" > /etc/apache2/conf-available/laravel.conf \
 && a2enconf laravel \
 && echo "ServerName localhost" > /etc/apache2/conf-available/servername.conf \
 && a2enconf servername

WORKDIR /var/www/html

# Composer peut tourner en root
ENV COMPOSER_ALLOW_SUPERUSER=1

# 👉 Forcer le chemin des vues compilées pour éviter realpath(false)
ENV VIEW_COMPILED_PATH=/var/www/html/storage/framework/views
ENV LOG_CHANNEL=stderr
ENV LOG_LEVEL=debug
# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copier l'app Laravel
COPY . .

# Créer les dossiers nécessaires AVANT composer install
RUN mkdir -p storage/framework/{cache,sessions,views} bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache

RUN composer require fakerphp/faker:^1.23 --no-interaction --no-progress --no-scripts

# 👉 OPTION 1 (à tester d'abord) : laisser les scripts
RUN composer install --no-dev --prefer-dist --optimize-autoloader

RUN php artisan config:clear && php artisan cache:clear && php artisan route:clear && php artisan view:clear

# Lier storage + créer base SQLite
RUN php artisan storage:link || true \
    && mkdir -p database && touch database/database.sqlite

# Copier le build Vite depuis le stage Node
COPY --from=assets /app/public/build ./public/build

# Permissions finales
RUN chown -R www-data:www-data storage bootstrap/cache database public/build

EXPOSE 80

# Démarrage: migrations + seeding (démo) puis Apache
CMD php artisan migrate --force --path=database/migrations/0001_01_01_000000_create_users_table.php \
 && php artisan migrate --force --path=database/migrations/0001_01_01_000001_create_cache_table.php \
 && php artisan migrate --force --path=database/migrations/0001_01_01_000002_create_jobs_table.php \
 && sqlite3 /var/www/html/database/database.sqlite "ALTER TABLE users ADD COLUMN username TEXT" || true \
 && sqlite3 /var/www/html/database/database.sqlite "ALTER TABLE users ADD COLUMN filiere TEXT" || true \
 && sqlite3 /var/www/html/database/database.sqlite "ALTER TABLE users ADD COLUMN year INTEGER" || true \
 && sqlite3 /var/www/html/database/database.sqlite "ALTER TABLE users ADD COLUMN profile_picture_type INTEGER" || true \
 && apache2-foreground


