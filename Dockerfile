#Construir assets de Node
FROM node:18-alpine AS node-builder

WORKDIR /app

# Copiar archivos de dependencias de Node
COPY package*.json ./

# Instalar dependencias de Node
RUN npm install

# Copiar código fuente necesario para Vite
COPY resources ./resources
COPY public ./public
COPY vite.config.js ./
COPY postcss.config.js ./
COPY tailwind.config.js ./

# Compilar assets con Vite para producción
RUN npm run build


# Imagen PHP principal
FROM php:8.2-fpm

# Argumentos
ARG user=laravel
ARG uid=1000

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    vim \
    cron \
    mariadb-client \
    mariadb-client-compat \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Instalar extensiones de PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Crear usuario del sistema
RUN useradd -G www-data,root -u $uid -d /home/$user $user && \
    mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Establecer directorio de trabajo
WORKDIR /var/www

# Copiar archivos del proyecto
COPY --chown=$user:$user . /var/www

# Copiar assets compilados desde la etapa de Node
COPY --from=node-builder /app/public/build /var/www/public/build

# Instalar dependencias de Composer
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Configurar cron para Laravel Scheduler
COPY docker/cron/laravel-scheduler /etc/cron.d/laravel-scheduler
RUN chmod 0644 /etc/cron.d/laravel-scheduler && \
    touch /var/log/cron.log

# Copiar y dar permisos al script de entrada
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Asegurar permisos correctos
RUN mkdir -p /var/www/storage/logs \
    /var/www/storage/framework/cache \
    /var/www/storage/framework/sessions \
    /var/www/storage/framework/views \
    /var/www/bootstrap/cache && \
    chown -R $user:$user /var/www/storage /var/www/bootstrap/cache && \
    chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Asegurar que los assets compilados tengan permisos correctos
RUN chown -R $user:$user /var/www/public/build && \
    chmod -R 755 /var/www/public/build

# Exponer puerto
EXPOSE 9000

VOLUME /var/www/storage

# Ejecutar como root para el entrypoint
USER root
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]