# Use the official PHP 8 image with Apache
FROM php:8.0-apache

# Setting up memory limit
RUN echo 'memory_limit = -1' >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini;

# Install required PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy custom PHP configuration file
COPY php.ini /usr/local/etc/php/

# Set the working directory
WORKDIR /var/www/html

COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Set file permissions
RUN chown -R www-data:www-data /var/www/html

# Enable Apache mod_rewrite (needed for PHP frameworks like Laravel)
RUN a2enmod rewrite

RUN service apache2 restart

# Expose Apache default port (80)
EXPOSE 80
