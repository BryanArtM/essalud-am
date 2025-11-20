#!/bin/bash
set -e

# Iniciar cron
echo "Iniciando cron daemon..."
cron

# Iniciar PHP-FPM
echo "Iniciando PHP-FPM..."
exec php-fpm
