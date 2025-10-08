# Base image
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    npm \
    nodejs \
    && docker-php-ext-install pdo pdo_pgsql

# Set working directory
WORKDIR /var/www/html

# Copy composer files
COPY composer.json composer.lock ./

# Install PHP dependencies
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader

# Copy the rest of the app
COPY . .

# Install JS dependencies and build assets
RUN npm install
RUN npm run build

# Expose port (if you are using php-fpm + nginx, adjust accordingly)
EXPOSE 9000

CMD ["php-fpm"]
