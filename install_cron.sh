#!/bin/bash

# Script para configurar el cron job de backups de EsSalud-AM
# Este script debe ejecutarse con permisos de administrador

echo "🔧 Configurando cron job para backups automáticos..."

# Verificar si el usuario actual tiene permisos
if [ "$EUID" -ne 0 ]; then 
    echo "❌ Por favor ejecuta este script como root o con sudo"
    exit 1
fi

# Determinar el usuario web server (usualmente www-data o el usuario actual)
WEB_USER="www-data"
if ! id "$WEB_USER" &>/dev/null; then
    WEB_USER=$SUDO_USER
    if [ -z "$WEB_USER" ]; then
        WEB_USER=$(whoami)
    fi
fi

# Ruta del proyecto
PROJECT_PATH="/var/www/essalud-am"

# Crear el trabajo de cron
CRON_JOB="0 */3 * * * cd $PROJECT_PATH && /usr/bin/php artisan schedule:run >> /dev/null 2>&1"

# Verificar si el cron job ya existe
(crontab -u $WEB_USER -l 2>/dev/null | grep -F "$PROJECT_PATH") || {
    echo "📅 Agregando cron job para el usuario $WEB_USER..."
    
    # Crear archivo temporal con el cron job actual + el nuevo
    TEMP_CRON=$(mktemp)
    crontab -u $WEB_USER -l 2>/dev/null > "$TEMP_CRON" || true
    echo "$CRON_JOB" >> "$TEMP_CRON"
    
    # Instalar el nuevo crontab
    crontab -u $WEB_USER "$TEMP_CRON"
    rm "$TEMP_CRON"
    
    echo "✅ Cron job instalado exitosamente!"
    echo "📋 Los backups se ejecutarán cada 3 horas automáticamente"
}

echo "
📊 Estado del cron job:
$(crontab -u $WEB_USER -l 2>/dev/null | grep -F "$PROJECT_PATH" || echo "No se encontró el cron job")

🔍 Para verificar que el cron job está funcionando:
- Revisa los logs en: $PROJECT_PATH/storage/logs/backup.log
- Ejecuta manualmente: cd $PROJECT_PATH && php artisan backup:database --only-db

💡 Para eliminar el cron job más tarde:
   crontab -u $WEB_USER -e
"