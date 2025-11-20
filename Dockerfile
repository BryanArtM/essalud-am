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
    nodejs \
    npm \
    cron

# Limpiar caché
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar extensiones de PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Crear usuario del sistema
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Establecer directorio de trabajo
WORKDIR /var/www

# Copiar archivos existentes
COPY --chown=$user:$user . /var/www

# Configurar cron para Laravel Scheduler
COPY docker/cron/laravel-scheduler /etc/cron.d/laravel-scheduler
RUN chmod 0644 /etc/cron.d/laravel-scheduler && \
    touch /var/log/cron.log

# Copiar y dar permisos al script de entrada
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Crear directorio de logs
RUN mkdir -p /var/www/storage/logs && \
    chown -R $user:$user /var/www/storage

# Cambiar a usuario no root
USER $user

# Exponer puerto
EXPOSE 9000

# Cambiar CMD por ENTRYPOINT
USER root
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]