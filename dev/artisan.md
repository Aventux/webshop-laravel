
# Development
- php artisan event:list

## ToDo:
- leasot 'app/**/*.php' ( https://github.com/pgilad/leasot )

# Database

## Migrate Database
- php artisan customMigrate:migrateDirectories
- php artisan migrate --seed


## Backup and Restore Database

- php artisan db:dbLocalBackup
- php artisan db:dbLocalRestore

# Vendor

- ./vendor/bin/phpstan analyse
- php artisan insights
- phpmd app/Http/Controllers text ./laravelmd.xml