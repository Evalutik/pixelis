FROM php:8.1-apache

# Install system deps and php extensions
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    git \
    && docker-php-ext-install zip mysqli pdo_mysql \
    && a2enmod rewrite

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy project
COPY . /var/www/html

# Install PHP deps
RUN composer install --no-dev --prefer-dist --no-interaction --optimize-autoloader || true

# Set permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
CMD ["apache2-foreground"]