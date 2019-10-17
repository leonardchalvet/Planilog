#!/usr/bin/env bash

# Any subsequent commands which fail will cause the shell script to exit immediately
set -e

DIR=/homez.254/planilogml/planilog
PHP=/usr/local/php7.2/bin/php

date >>storage/logs/git.log 2>&1
cd ${DIR}

${PHP} artisan env >>storage/logs/git.log 2>&1

# Mode maintenance (=> http 503)
${PHP} artisan down >>storage/logs/git.log 2>&1

git pull >>storage/logs/git.log 2>&1
#/usr/local/php7.2/bin/php ../composer install --optimize-autoloader --no-dev >>storage/logs/git.log 2>&1

${PHP} artisan cache:clear >>storage/logs/git.log 2>&1

${PHP} artisan config:clear >>storage/logs/git.log 2>&1
${PHP} artisan config:cache >>storage/logs/git.log 2>&1

${PHP} artisan route:clear  >>storage/logs/git.log 2>&1
#${PHP} artisan route:cache >>storage/logs/git.log 2>&1

${PHP} artisan view:clear >>storage/logs/git.log 2>&1

# Mode live
${PHP} artisan up >>storage/logs/git.log 2>&1

