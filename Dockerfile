FROM php:8.2-fpm-alpine

# Install sistem dependencies dan ekstensi PHP yang dibutuhkan Laravel
RUN apk add --no-cache \
    nginx \
    supervisor \
    curl \
    libpng-dev \
    libxml2-dev \
    zip \
    unzip \
    git

RUN docker-php-ext-install pdo_mysql bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy seluruh file projek ke dalam container
COPY . .

# Install dependencies Laravel
RUN composer install --no-dev --optimize-autoloader

# Atur izin folder storage dan bootstrap agar bisa ditulis oleh server
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Konfigurasi Port untuk Render
EXPOSE 80

# Jalankan migrasi database lalu jalankan server bawaan artisan
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT
