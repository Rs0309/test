FROM php:8.2-apache

# Enable Apache rewrite module
RUN a2enmod rewrite

# Install mysqli for MySQL connection
RUN docker-php-ext-install mysqli

# Copy all files into Apache root
COPY . /var/www/html/

WORKDIR /var/www/html/

EXPOSE 80
