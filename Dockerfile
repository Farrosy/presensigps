FROM php:8.2-cli

# Install dependencies
RUN apt-get update && apt-get install -y \
    zip unzip git curl libzip-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Set correct permissions (optional but helpful)
RUN chmod -R 755 /app && chown -R www-data:www-data /app

# Serve Laravel using PHP built-in server
CMD php -S 0.0.0.0:8080 -t public