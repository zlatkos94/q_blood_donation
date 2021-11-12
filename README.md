# Install dependencies
composer install

# Database Create
php bin/console doctrine:database:create

# Migrate to database
php bin/console doctrine:migrations:migrate

# Seed data 
php bin/console hautelook:fixtures:load
