# 1. Használjuk az official PHP 8.4 FPM imaget (vagy amilyen verziót használsz)
FROM php:8.4-fpm

# 2. Telepítsük a szükséges PHP kiterjesztéseket (pl. fileinfo, pdo, mbstring, xml stb.)
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath xml

# 3. Composer telepítése
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 4. Munkakönyvtár beállítása
WORKDIR /var/www/html

# 5. A projekt fájljainak bemásolása
COPY . .

# 6. Composer függőségek telepítése (production/dev az igényektől függ)
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# 7. Jogosultságok beállítása (opcionális, ha pl. storage és cache folderhez kell)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 8. A PHP-FPM futtatása konténer indításakor
CMD ["php-fpm"]

# 9. Exponált port, ha kell (általában a PHP-FPM nem publikus port, de ha pl. Valet, akkor más)
EXPOSE 9000
