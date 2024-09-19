#!/bin/bash

# Run fresh database migration and seed data
php /var/www/html/artisan migrate:fresh --seed --force

# Start Apache
apache2-foreground