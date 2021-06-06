#!/bin/bash
echo "ejecutando migraciones..."
php artisan migrate:fresh >> logs/migrate.txt
echo "migraciones listas"
echo "ejecutando seed..."
php artisan db:seed >> logs/seed.txt
echo "seed creados"
php artisan test

