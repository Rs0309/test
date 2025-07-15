# Use an official PHP image with Apache and mysqli installed
FROM php:8.1-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli

# Copy your PHP code into the container
COPY . /var/www/html/

# Set working directory (optional but good practice)
WORKDIR /var/www/html
