FROM php:8.3-fpm-alpine

# Install dependencies
RUN apk add --no-cache git unzip curl

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . .

# Install PHP dependencies
RUN composer install --optimize-autoloader --no-dev

# Set permissions
RUN chmod -R 775 storage bootstrap/cache

# Expose port
EXPOSE 8000

# Start the server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]