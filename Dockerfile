FROM php:8.2-apache

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN apt-get update && apt-get install -y \
    libzip-dev unzip git \
    && docker-php-ext-install zip pdo pdo_sqlite \
    && docker-php-ext-enable pdo_sqlite

RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data /var/www/html/storage \
    && chown -R www-data:www-data /var/www/html/database \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/database

EXPOSE 80

CMD ["apache2-foreground"]