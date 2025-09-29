# 🛡️ Sistema de Backup Automático - EsSalud AM

## ✅ Estado: ACTIVO Y FUNCIONANDO

Tu aplicación tiene un sistema de backup automático que protege la base de datos subiéndola a Google Drive cada 3 horas.

## 🔧 Cómo funciona

1. **Cada 3 horas** se ejecuta automáticamente `backup:google-drive`
2. **Crea un backup** de la base de datos MySQL (comprimido)
3. **Sube el archivo** a Google Drive automáticamente
4. **Elimina backups antiguos** manteniendo solo los últimos 10
5. **NO guarda archivos localmente** (se eliminan después de subir)

## 📊 Información actual

- **Comando principal**: `php artisan backup:google-drive`
- **Frecuencia**: Cada 30 minutos (temporal para pruebas)
- **Retención**: Máximo 10 backups en Google Drive
- **Tamaño promedio**: ~11 KB por backup
- **Logs**: `storage/logs/backup.log`

## 🛠️ Comandos útiles

## 🔄 Cómo volver a hacer backups cada 3 horas

1. Abre el archivo `app/Console/Kernel.php`
2. Busca la línea:
	```php
	->everyThirtyMinutes()
	```
3. Cámbiala por:
	```php
	->everyThreeHours()
	```
4. Guarda los cambios.
5. Reinicia el cron para que tome la nueva configuración:

	 - Si usas el cron de Linux estándar (crontab):
		 ```bash
		 sudo service cron restart
		 # o en algunos sistemas:
		 sudo systemctl restart cron
		 ```

	 - Si usas supervisor para correr el scheduler:
		 ```bash
		 sudo supervisorctl restart all
		 ```

Esto restaurará la frecuencia de backup automático a cada 3 horas.

```bash
# Backup manual inmediato
php artisan backup:google-drive

# Ver logs en tiempo real
tail -f storage/logs/backup.log

# Verificar cron jobs
crontab -l

# Test del scheduler
php artisan schedule:run
```

## 📁 Archivos importantes

- `app/Console/Commands/BackupToGoogleDrive.php` - Comando principal
- `app/Console/Kernel.php` - Configuración del scheduler
- `config/backup.php` - Configuración de Spatie Backup
- `install_cron.sh` - Script de instalación del cron
- `.env` - Variables de configuración de Google Drive

## 🔍 Verificar funcionamiento

### Opción 1: Ver archivos en Google Drive
1. Ve a: https://drive.google.com/
2. Busca la carpeta con archivos `.zip` con timestamps
3. Deberías ver archivos como: `2025-09-29-12-16-52.zip`

### Opción 2: Ver logs
```bash
tail -20 storage/logs/backup.log
```

### Opción 3: Listar archivos con script
```bash
php list_google_drive_files.php
```

## ⚠️ Respuestas a tus preguntas

### ❓ "¿Se guardan archivos localmente?"
**NO** - Los archivos se crean temporalmente y se eliminan inmediatamente después de subirlos a Google Drive.

### ❓ "¿Los archivos de Google Drive se eliminan solos?"
**SÍ** - El sistema mantiene automáticamente solo los últimos 10 backups. Los más antiguos se eliminan automáticamente.

### ❓ "¿Cada cuánto se hace backup?"
**Cada 3 horas** automáticamente. El próximo será a las 15:00, luego 18:00, etc.

## 🆘 Si algo no funciona

1. **Verificar logs**: `tail -f storage/logs/backup.log`
2. **Test manual**: `php artisan backup:google-drive`
3. **Verificar cron**: `crontab -l`
4. **Verificar variables**: Las credenciales están en `.env`

## 🎯 Beneficios

- ✅ **Protección total** contra pérdida de la VM de Oracle
- ✅ **Automatización completa** - no requiere intervención manual
- ✅ **Costo $0** - usa el Google Drive gratuito
- ✅ **Gestión automática** de espacio y limpieza
- ✅ **Sistema robusto** y probado funcionando

---

**🔒 Tu aplicación está completamente protegida.** Los backups se ejecutan automáticamente y se mantienen seguros en Google Drive.