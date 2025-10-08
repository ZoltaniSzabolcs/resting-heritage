# ------------------------
# Stage 1: Build stage
# ------------------------
FROM composer:2 AS composer_stage
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts
# ------------------------
# Stage 2: Frontend build
# ------------------------
FROM node:20 AS node_stage
WORKDIR /app
COPY package*.json vite.config.js ./
RUN npm ci
COPY resources ./resources
COPY public ./public
RUN npm run build

# ------------------------
# Stage 3: Production image
# ------------------------
FROM php:8.3-apache as production

WORKDIR /var/www/html

# Szükséges extension-ök
RUN apt-get update && apt-get install -y git unzip libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Apache beállítás
RUN a2enmod rewrite

# Laravel public beállítása DocumentRoot-ként
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Engedélyezd az .htaccess-t
RUN echo '<Directory /var/www/html/public>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/conf-available/laravel.conf \
    && a2enconf laravel

COPY . .

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Laravel optimalizálás
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

EXPOSE 80

CMD ["apache2-foreground"]
