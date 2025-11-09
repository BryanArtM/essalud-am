<p align="center">
  <img src="public/favicon.ico" width="400" alt="Logo EsSalud-AM">
</p>



<h1 align="center">🧓 EsSalud-AM: Sistema de Gestión de Adultos Mayores</h1>

<p align="center">
  <b>Gestión de información clínica, social y de riesgo para adultos mayores.</b><br>
  <img src="https://img.shields.io/badge/Laravel-12.x-red?logo=laravel" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.2-blue?logo=php">
  <img src="https://img.shields.io/badge/Livewire-3.x-purple?logo=livewire">
  <img src="https://img.shields.io/badge/TailwindCSS-4.x-teal?logo=tailwindcss">
  <img src="https://img.shields.io/badge/Estado-Activo-brightgreen">
  <img src="https://img.shields.io/badge/Idioma-Español-yellow">
</p>

---

## 📋 Descripción

EsSalud-AM es una plataforma web para la gestión y seguimiento de adultos mayores, permitiendo registrar, consultar y analizar información clínica, social, de riesgo, evaluaciones, tratamientos, actividades educativas y más. Está diseñada para facilitar el trabajo de profesionales de la salud y cuidadores, mejorando la atención integral de esta población vulnerable.

## 🚀 Características principales

-   Registro y gestión de adultos mayores (datos personales, contacto, historial)
-   Valoraciones geriátricas (autovalencia, tests funcionales, fragilidad, fechas de atención)
-   Control de enfermedades crónicas y factores de riesgo
-   Registro de citas, tratamientos, evaluaciones médicas y actividades educativas
-   Generación de fichas PDF completas y reportes
-   Panel de Administración
    - Gestión de Usuarios 
    - Reportes y Estadísticas
    - Gestión de Caché
    - Acceso Rápido
    - Estadísticas de BD

-   Sistema de backup automático a Google Drive
-   Interfaz moderna y responsiva (Tailwind CSS, Livewire)







## 🏗️ Arquitectura del Proyecto

```
essalud-am/
├── app/
│   ├── Console/
│   │   ├── Commands/          # Comandos Artisan personalizados
│   │   └── Kernel.php          # Scheduler para backups automáticos
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AdultoMayorController.php      # CRUD adultos mayores
│   │   │   ├── AdultoMayorWizardController.php # Wizard de registro
│   │   │   └── UserController.php              # Gestión usuarios + caché
│   │   └── Middleware/
│   │       └── IsAdmin.php     # Protección rutas admin
│   ├── Models/
│   │   ├── AdultoMayor.php
│   │   ├── Valoracion.php
│   │   ├── Evaluacion.php
│   │   ├── Tratamiento.php
│   │   ├── Enfermedad.php
│   │   ├── Riesgo.php
│   │   ├── Cita.php
│   │   ├── ActividadEducativa.php
│   │   └── User.php
│   └── Providers/
│       └── ScheduleServiceProvider.php # Programación de tareas
├── resources/
│   ├── views/
│   │   ├── admin/
│   │   │   ├── index.blade.php # Vista principal admin
│   │   │   └── partials/
│   │   │       ├── usuarios.blade.php    # Gestión usuarios
│   │   │       ├── reportes.blade.php    # Dashboard estadísticas
│   │   │       └── configuracion.blade.php # Configuración sistema
│   │   ├── adultos/
│   │   │   ├── index.blade.php # Listado adultos mayores
│   │   │   ├── show.blade.php  # Ficha completa
│   │   │   └── pdf.blade.php   # Template PDF
│   │   └── wizard/             # 6 pasos del wizard
│   └── css/ & js/
├── database/
│   ├── migrations/
│   └── seeders/
├── routes/
│   └── web.php
│   
├── config/
│   ├── backup.php              # Configuración backups
│   └── google_drive.php        # Integración Google Drive
└── public/
```

## ⚙️ Instalación rápida

1. **Clonar el repositorio**
   ```bash
   git clone https://github.com/BryanArtM/essalud-am.git
   cd essalud-am
   ```

2. **Instalar dependencias PHP**
   ```bash
   composer install
   ```

3. **Instalar dependencias JavaScript**
   ```bash
   npm install
   ```

4. **Configurar variables de entorno**
   ```bash
   cp .env.example .env
   ```
   Edita el archivo `.env` con tus credenciales:
   ```env
   DB_DATABASE=essalud_am
   DB_USERNAME=tu_usuario
   DB_PASSWORD=tu_contraseña
   
   # Google Drive (opcional)
   GOOGLE_DRIVE_CLIENT_ID=
   GOOGLE_DRIVE_CLIENT_SECRET=
   GOOGLE_DRIVE_REFRESH_TOKEN=
   ```

5. **Generar clave de aplicación**
   ```bash
   php artisan key:generate
   ```

6. **Ejecutar migraciones**
   ```bash
   php artisan migrate
   ```

7. **Poblar base de datos (opcional)**
   ```bash
   php artisan db:seed
   ```
   Esto creará:
   - Usuario administrador: `admin@gmail.com` / `Admin123!`
   - Actividades educativas predefinidas
   - Datos de ejemplo

8. **Compilar assets**
   ```bash
   npm run build
   # O para desarrollo con hot reload:
   npm run dev
   ```

9. **Iniciar servidor**
   ```bash
   php artisan serve
   ```
   Accede a: `http://localhost:8000`

## 🔧 Configuración Adicional

### Google Drive Backup
Para habilitar backups automáticos a Google Drive:

1. Crear proyecto en Google Cloud Console
2. Habilitar Google Drive API
3. Crear credenciales OAuth 2.0
4. Configurar variables en `.env`
5. Ejecutar: `php artisan backup:google-drive` para validar conexión

### Cron para Backups Automáticos
Agrega a tu crontab (Linux/Mac):
```bash
* * * * * cd /ruta/essalud-am && php artisan schedule:run >> /dev/null 2>&1
```


Ejecutar cada minuto (Laravel se encarga del timing interno)

## 🛠️ Comandos Útiles

### Desarrollo
```bash
# Servidor de desarrollo
php artisan serve

# Compilar assets en tiempo real
npm run dev

# Limpiar caché
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Ver rutas
php artisan route:list
```

### Base de Datos
```bash
# Ejecutar migraciones
php artisan migrate

# Revertir última migración
php artisan migrate:rollback

# Refrescar BD (elimina todo y recrea)
php artisan migrate:fresh --seed

# Poblar con seeders
php artisan db:seed
```

### Producción
```bash
# Optimizar aplicación
php artisan optimize

# Compilar assets para producción
npm run build

# Cachear configuración
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Backup
```bash
php artisan backup:google-drive
```

## 🛠️ Comandos útiles

-   `php artisan migrate` — Ejecutar migraciones
-   `php artisan db:seed` — Poblar la base de datos
-   `php artisan serve` — Servidor local
-   `npm run dev` — Compilar assets en modo desarrollo
-   `npm run build` — Compilar assets para producción

## 👤 Autor

-   BryanArtM ([github.com/BryanArtM](https://github.com/BryanArtM))

## 📄 Licencia

Este proyecto está bajo licencia MIT. Ver [LICENSE](LICENSE).
