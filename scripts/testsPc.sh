#!/bin/bash
echo "ejecutando migraciones......"
./vendor/bin/sail artisan migrate:fresh >> logs/migrate.txt
echo "-migraciones listas"
echo "ejecutando seed......"
./vendor/bin/sail artisan db:seed >> logs/seed.txt
echo "-seed creados"
./vendor/bin/sail artisan test
