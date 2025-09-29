<p align="center">
  <img src="public/favicon.ico" width="400" alt="Logo EsSalud-AM">
</p>



<h1 align="center">🧓 EsSalud-AM: Sistema de Gestión de Adultos Mayores</h1>

<p align="center">
  <b>Gestión de información clínica, social y de riesgo para adultos mayores.</b><br>
  <img src="https://img.shields.io/badge/Laravel-12.x-red?logo=laravel" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.2-blue?logo=php">
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
-   Panel de administración de usuarios (con roles)
-   Sistema de backup automático a Google Drive
-   Interfaz moderna y responsiva (Tailwind CSS, Livewire)

## 🏗️ Estructura del proyecto

```
├── app/                # Lógica de negocio, modelos, controladores
├── resources/          # Vistas Blade, assets, markdown
├── routes/             # Definición de rutas web y API
├── database/           # Migraciones, seeders, factories
├── public/             # Archivos públicos y punto de entrada
├── config/             # Configuración de la app y paquetes
├── composer.json       # Dependencias PHP
├── package.json        # Dependencias JS/CSS
└── README.md           # Este archivo
```

## ⚙️ Instalación rápida

1. Clona el repositorio y entra al directorio:
    ```bash
    git clone https://github.com/BryanArtM/essalud-am.git
    cd essalud-am
    ```
2. Instala dependencias PHP y JS:
    ```bash
    composer install
    npm install
    ```
3. Copia el archivo de entorno y configura tu base de datos:
    ```bash
    cp .env.example .env
    # Edita .env según tu entorno
    php artisan key:generate
    ```
4. Ejecuta migraciones y (opcional) seeders:
    ```bash
    php artisan migrate --seed
    ```
5. Inicia el servidor de desarrollo:
    ```bash
    npm run dev
    php artisan serve
    ```

## 🔐 Requisitos

-   PHP >= 8.2
-   Node.js >= 18
-   Composer
-   MySQL/MariaDB

## 🧩 Principales dependencias

-   Laravel 12.x
-   Jetstream, Fortify, Sanctum, Livewire
-   Tailwind CSS, Vite
-   barryvdh/laravel-dompdf (PDF)

## 🗄️ Sistema de Backup Automático

El sistema realiza backups automáticos de la base de datos y los sube a Google Drive cada 3 horas. Puedes ver y restaurar backups fácilmente. Logs en `storage/logs/backup.log`.

**Comando manual:**

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
