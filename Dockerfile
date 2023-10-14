FROM node:16.20 AS node
FROM php:8.1.7-apache

# Arguments defined in docker-compose.yml
ARG user
ARG uid

COPY --from=node /usr/local/lib/node_modules /usr/local/lib/node_modules
COPY --from=node /usr/local/bin/node /usr/local/bin/node
RUN ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm

RUN node -v
RUN npm -v

ENV TZ="Asia/Jakarta"

RUN mkdir -p "/etc/supervisor/logs"

# Make supervisor log directory
RUN mkdir -p /var/log/supervisor

RUN apt-get update \
  && apt-get install -y \
  git \
  curl \
  libpng-dev \
  libonig-dev \
  libxml2-dev \
  zip \
  unzip \
  zlib1g-dev \
  libpq-dev \
  libzip-dev

RUN apt-get install supervisor tzdata -qqy  --no-install-recommends


# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP Ext
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
  && docker-php-ext-install pdo pdo_pgsql pgsql zip bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
# RUN useradd -G www-data,root -u $uid -d /home/$user $user
# RUN mkdir -p /home/$user/.composer && \
#     chown -R $user:$user /home/$user


# Set working directory
WORKDIR /var/www/html

COPY . .
# Install required app files
RUN composer install
# RUN cp .env.example .env
RUN chmod -R 0777 /var/www/html/storage
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html/public/build
RUN php artisan key:generate

# Enable mod_rewrite
RUN a2enmod rewrite

RUN npm install
# RUN npm run build

# USER $user

# Ubah konfigurasi document_root ke public Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copy local supervisord.conf to the conf.d directory
COPY --chown=root:root supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Start supervisord
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/supervisord.conf"]

