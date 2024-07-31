# Use the official PHP image with Apache, PHP 7.4 version
FROM php:8.2-apache

# Install system dependencies for PostgreSQL PDO
RUN apt-get update && apt-get install -y libpq-dev && \
    docker-php-ext-install pdo pdo_pgsql

# Enable Apache mod_rewrite for Symfony's .htaccess
RUN a2enmod rewrite

# Set the working directory inside the container to the Apache document root
WORKDIR /var/www/html

# Copy the application code to the working directory
COPY . .

# Use Composer to install PHP dependencies
# Note: Ensure you have a composer.json and potentially a composer.lock in your project root
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Correct permissions for Symfony
RUN chown -R www-data:www-data /var/www/html/var /var/www/html/vendor

# Expose port 80 of the container
EXPOSE 80
