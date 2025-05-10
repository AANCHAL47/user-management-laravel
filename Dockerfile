# Use the official PHP image with Apache
FROM php:8.1-apache

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install PHP extensions required for Laravel
RUN docker-php-ext-install pdo pdo_mysql bcmath ctype fileinfo json mbstring

# Install Composer (PHP dependency manager)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory
WORKDIR /var/www/html

# Copy the Laravel project files into the container
COPY . .

# Install PHP dependencies with Composer
RUN composer install --no-dev --optimize-autoloader --prefer-dist

# Set the correct permissions for storage and cache directories
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Expose the port on which the Laravel app will run
EXPOSE 80

# Use Apache as the web server
CMD ["apache2-foreground"]
