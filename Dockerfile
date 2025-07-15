FROM php:8.2-apache

# Enable mod_rewrite if needed
RUN a2enmod rewrite

# Copy your PHP files to Apache's web root
COPY . /var/www/html/

# Set proper permissions (optional but good practice)
RUN chown -R www-data:www-data /var/www/html
