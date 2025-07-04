#!/usr/bin/env bash
# Start the web server
exec php artisan serve --host=0.0.0.0 --port=$PORT
