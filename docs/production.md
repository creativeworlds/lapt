# Production Deployment Guide

Complete guide for deploying the Laravel Application to a production server.

## Prerequisites

Before deployment, ensure you have:
- Access to production server (SSH/FTP)
- MySQL/MariaDB database server
- PHP 8.1 or higher with required extensions
- Composer installed on production server
- Node.js and Bun installed (for building frontend)

## Deployment Steps

### 1. Build Frontend Assets

Build the frontend assets for production:

```bash
bun run build
```

This creates an optimized `public/build` folder with all frontend assets.


### 2. Create a new database on your production server.

### 3. Create a zip archive of your project.

### 4. Upload to Production Server

- Create project folder on production server:
```bash
mkdir /var/www/project_name
```

- Upload `project_name.zip` to the server.

- Extract the archive:
```bash
cd /var/www/project_name
unzip project_name.zip
```

### 5. Install Dependencies

Install PHP dependencies using Composer:

```bash
composer install --optimize-autoloader --no-dev
```

### 6. Environment Configuration

- Copy environment file:
```bash
cp .env.example .env
```

- Generate application key:
```bash
php artisan key:generate
```

- Update `.env` with production credentials:
```env
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=rsfgqdfp_laravel.lapt
DB_USERNAME=rsfgqdfp_pramod
DB_PASSWORD=06@Sep1997
```

### 7. Run Database Migrations

Execute migrations and seeders:

```bash
php artisan migrate --seed
```

### 8. Configure Public Directory

Copy all files and folders from Laravel's `public` directory to your web server's root directory:

```bash
cp -R public/* /var/www/html/
```

### 9. Create Storage Symlink

Create a symbolic link from `public/storage` to `storage/app/public`:

**Method 1 - Using Laravel Artisan (Recommended):**
```bash
php artisan storage:link
```

**Method 2 - Manual symlink (if deploying to root folder):**
```bash
ln -s /var/www/project_name/storage/app/public storage
```

**Method 3 - Full path symlink:**
```bash
ln -s /var/www/project_name/storage/app/public /var/www/project_name/public/storage
```

### 10. Optimize for Production

Run Laravel optimization commands:

```bash
# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# Optimize autoloader
composer dump-autoload --optimize
```

### License 
MIT License. © 2025 [FullStackOnDemand](https://github.com/fullstackondemand)