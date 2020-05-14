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

...and set others parameters:

```
php artisan key:generate
```


**Set directory permissions**

```
chmod -R 777 storage/*
chmod -R 777 bootstrap/cache
```


# Deploy

## Dev

Just do a `git pull`.

```
php artisan serve --host 0.0.0.0 --port 8002
```

## Production

Run the script `gitwebhook2.sh` to deploy the branch `master`. It runs the following commands :

- `php artisan down` to put the website in maintenance mode (the website will return an HTTP 503)
- `git pull` to pull the latest version
- `php artisan cache:clear` to clear and warmup laravel's cache.
- `php artisan config:clear` to clear and warmup the config
- `php artisan route:clear` to clear and warmup the routes
- `php artisan view:clear` to clear and warmup the views
- `php artisan up` to go back in live mode if everything went fine


### Autodeploy

There is a github webhook run on any `push` on the repo which will call a POST on `/git-webhook`. If the branch is `master`, il will run the script `gitwebhook2.sh`.

To get a slack notification on an autodeploy, change the `LOG_SLACK_WEBHOOK_URL` parameter in the `.env` file.
The webhook url can be find in slack > add an app > app "incoming-webhook" > settings > "Webhook URL"
