# Use the official PHP image with Apache
FROM php:8.1-apache

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install PHP extensions required for Laravel
RUN docker-php-ext-install pdo pdo_mysql

# Install Composer (PHP dependency manager)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory
WORKDIR /var/www/html

# Copy the Laravel project files into the container
COPY . .

# Install PHP dependencies with Composer
RUN composer install --no-dev --optimize-autoloader

# Expose the port on which the Laravel app will run
EXPOSE 80

# Run the Laravel artisan server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=80"]
