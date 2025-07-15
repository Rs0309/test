# Use PHP 8.2 with Apache
FROM php:8.2-apache

# Install mysqli (needed for DB connections)
RUN docker-php-ext-install mysqli

# Copy your PHP code into Apache web root
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html
