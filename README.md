# Overview

restful api library with laravel or lumen.

# Installation

To install this package you will need:

* Laravel 5.1+ or Lumen 5.1+
* PHP 5.5.9+

You must then modify your composer.json file and run composer update to include the latest version of the package in your project.

```composer
"require": {
    "qijitech/api-starter-kit": "dev-master"
}
```

# Laravel

Open config/app.php and register the required service provider above your application providers.

```php
'providers' => [
    Api\StarterKit\Providers\ApiStarterKitServiceProvider::class
]
```

If you'd like to make configuration changes in the configuration file you can pubish it with the following Aritsan command:

```php
php artisan vendor:publish
```

# Lumen

```composer
"require": {
    "qijitech/api-starter-kit": "dev-lumen"
}
```

Open bootstrap/app.php and register the required service provider.

```php
$app->register(Api\StarterKit\Providers\LumenServiceProvider::class)
```

# Sample Code

You can find the sample code [here](https://github.com/qijitech/fakerapi). Note that you'll need to run composer install to install all the dependencies.


