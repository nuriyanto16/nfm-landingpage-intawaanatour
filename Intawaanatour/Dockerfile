# Intawaanatour - PHP 8.2 + Apache untuk CodeIgniter 4
FROM php:8.2-apache

# Dependency sistem untuk ekstensi PHP
RUN apt-get update && apt-get install -y \
        libicu-dev \
        libonig-dev \
        libzip-dev \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        unzip \
        git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" intl mbstring gd mysqli pdo_mysql zip \
    && rm -rf /var/lib/apt/lists/*

# Aktifkan mod_rewrite, kompresi & cache, lalu arahkan DocumentRoot ke folder public CI4
RUN a2enmod rewrite deflate expires headers \
    && sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!/var/www/html/public!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Izinkan .htaccess override
RUN printf '<Directory /var/www/html/public>\n    AllowOverride All\n    Require all granted\n</Directory>\n' > /etc/apache2/conf-available/ci4.conf \
    && a2enconf ci4

# Composer dari image resmi
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
