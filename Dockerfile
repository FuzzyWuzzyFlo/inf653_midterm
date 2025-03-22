# Use the official PHP image with Apache
FROM php:8.2-apache

# Install PostgreSQL extension
RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_pgsql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set document root
WORKDIR /var/www/html

# Copy project files into container
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html

# Expose port 80 (NOT 1000)
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]
