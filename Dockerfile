# Utilise PHP 8.2 avec Apache
FROM php:8.2-apache

# Installe les extensions nécessaires à Laravel
RUN apt-get update && apt-get install -y \
    libonig-dev libzip-dev unzip git curl sqlite3 libsqlite3-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite mbstring zip bcmath

# Active mod_rewrite pour Laravel
RUN a2enmod rewrite

# Copie le code dans le container
WORKDIR /var/www/html
COPY . .

# Installe Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Installe les dépendances PHP
RUN composer install --no-dev --prefer-dist --optimize-autoloader

# Crée fichier SQLite et migrations
RUN mkdir -p database && touch database/database.sqlite

# Build du front (si ton projet utilise Vite)
RUN apt-get install -y nodejs npm \
    && npm install \
    && npm run build \
    && rm -rf node_modules

# Permissions storage/cache
RUN chown -R www-data:www-data storage bootstrap/cache database

# Expose le port 80
EXPOSE 80

# Commande de démarrage
CMD php artisan migrate --force --seed && apache2-foreground
