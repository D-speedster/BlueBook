# BlueBook

A Laravel-based bookstore management system with admin panel.

All rights reserved.

## Requirements

- PHP 8.2 or higher with extensions:
  - BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML
  - intl (for internationalization)
  - zip (for package management)
- Composer 2.x
- Node.js 18+ and npm
- MySQL 8.0+ or PostgreSQL 13+ (SQLite for local testing)

## Local Installation

```bash
# Clone the repository
git clone https://github.com/D-speedster/BlueBook.git
cd BlueBook

# Install PHP dependencies
composer install

# Install Node dependencies
npm install

# Environment setup
cp .env.example .env
php artisan key:generate

# Configure database in .env
# For local: DB_CONNECTION=sqlite (default)
# For production: set DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD

# Create database and run migrations
php artisan migrate

# Create storage symlink
php artisan storage:link

# Build assets
npm run build

# Create admin user (Filament)
php artisan make:filament-user
```

## Development

```bash
# Start development server
php artisan serve

# Watch and compile assets
npm run dev

# Run queue worker
php artisan queue:work

# View logs
php artisan pail
```

## Testing

```bash
php artisan test
```

## Deployment

### Server with Internet Access

```bash
# Pull latest code
git pull origin main

# Install dependencies (production optimized)
composer install --no-dev --optimize-autoloader

# Build assets
npm ci
npm run build

# Run migrations
php artisan migrate --force

# Optimize Laravel
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Create storage symlink (first time only)
php artisan storage:link

# Restart queue workers
php artisan queue:restart
```

### Server without International Internet

On your local machine with internet:

```bash
# Install all dependencies
composer install --no-dev --optimize-autoloader
npm ci
npm run build

# Upload these directories to server:
# - vendor/
# - node_modules/ (if needed for server-side rendering)
# - public/build/
```

On the server:

```bash
# Set permissions
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Run migrations and optimize
php artisan migrate --force
php artisan optimize
php artisan storage:link
```

## Tech Stack

- Laravel 12
- Filament 5 (Admin Panel)
- Livewire 4
- Tailwind CSS
- Vite

## License

Proprietary. All rights reserved.
