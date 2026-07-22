# Start Laravel development server
serve:
    php artisan serve

# Run migrations
migrate:
    php artisan migrate

# Run migrations fresh with seeders
fresh:
    php artisan migrate:fresh --seed

# Install PHP dependencies
install:
    composer install

# Update PHP dependencies
update:
    composer update

# Run tests
test:
    php artisan test

# Open Tinker
tink:
    php artisan tinker

# Clear Laravel caches
clear:
    php artisan optimize:clear

# Build frontend assets
build:
    npm run build

# Run Native Jump
jump:
    php artisan native:jump

# Run PHPStan
stan:
    composer analyse
