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

# Bind Apache to 0.0.0.0 and expose port 10000 (for Render)
EXPOSE 10000

# Change Apache to listen on port 10000
RUN sed -i 's/Listen 80/Listen 10000/' /etc/apache2/ports.conf
RUN sed -i 's/<VirtualHost \*:80>/<VirtualHost \*:10000>/' /etc/apache2/sites-available/000-default.conf

# Start Apache in the foreground
CMD ["apache2-foreground"]

