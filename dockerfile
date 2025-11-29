FROM php:8.2-apache

WORKDIR /var/www/html

# Habilita mod_rewrite por si hay URLs amigables
RUN a2enmod rewrite

# Copia el código de la app
COPY . /var/www/html

# Instala extensiones para PostgreSQL (pgsql y PDO)
RUN apt-get update \
    && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo_pgsql pgsql \
    && rm -rf /var/lib/apt/lists/*

EXPOSE 80
