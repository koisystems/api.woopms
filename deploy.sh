#/bin/bash
# Install Composer dependencies optimized for production
composer install --prefer-dist --optimize-autoloader --no-dev

# Perform extra tasks for your framework of choice
# (e.g. generate the framework cache)
# [...]

# Deploy
serverless deploy
