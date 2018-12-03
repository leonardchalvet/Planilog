# Requirements

- PHP > 7.1.3
- php_intl extension

# Installation

**Composer**
```
wget https://getcomposer.org/composer.phar -o composer
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

Edit `.env`

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

``` 
composer install
```

**Cache backend ressources and configuration**

``` 
composer install --optimize-autoloader --no-dev

php artisan cache:clear

php artisan config:clear 
php artisan config:cache

php artisan route:clear 
php artisan route:cache

php artisan view:clear
```
