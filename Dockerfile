FROM node:16.17 as nodevite
RUN mkdir -p /app
WORKDIR /app
COPY ./ /app/
RUN npm install -g npm@latest && \
    npm install && \
    npm run build

# FROM php:8.1-fpm

# # Arguments defined in docker-compose.yml
# ARG user
# ARG uid

# RUN apt-get update \
#   && apt-get install -y \
#   git \
#   curl \
#   libpng-dev \
#   libonig-dev \
#   libxml2-dev \
#   zip \
#   unzip \
#   zlib1g-dev \
#   libpq-dev \
#   libzip-dev

# # Clear cache
# RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# # Install PHP Ext
# RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
#   && docker-php-ext-install pdo pdo_pgsql pgsql zip bcmath gd

# # Get latest Composer
# COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# # Create system user to run Composer and Artisan Commands
# RUN useradd -G www-data,root -u $uid -d /home/$user $user
# RUN mkdir -p /home/$user/.composer && \
#     chown -R $user:$user /home/$user

# COPY --chown=www-data:www-data --from=nodevite /app/public/build /var/www/public/build

# # Set working directory
# WORKDIR /var/www

# #RUN composer install

# USER $user