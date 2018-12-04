# Requirements

- PHP > 7.1.3
- php_intl extension

# Installation

**Composer**
```
wget https://getcomposer.org/composer.phar -O composer
```

**Clone repository**
```
git clone https://github.com/leonardchalvet/Planilog planilog
cd planilog
``` 

**Composer**
```
wget https://getcomposer.org/composer.phar -o composer
```

**Install backend dependancies**
``` 
../composer install
```

**Configure application**

```
cp .env.example .env
php artisan key:generate
```

Edit `.env`:

```
APP_ENV=production
APP_DEBUG=false
```

...and set others parameters.

```
php artisan key:generate
```


**Set directory permissions**

```
chmod -R 777 storage/*
chmod -R 777 bootstrap/cache
```


# Deploy

## Production

**Get last version**

``` 
git pull
``` 

**Update dependancies**

Change `.env` if needed.

``` 
../composer install --optimize-autoloader --no-dev

```

**Cache backend ressources and configuration**

``` 
php artisan cache:clear

php artisan config:clear 
php artisan config:cache

php artisan route:clear 
php artisan route:cache

php artisan view:clear
```
