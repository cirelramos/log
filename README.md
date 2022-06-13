# logs

[![Software License][ico-license]](LICENSE.md)

## About

The `logs` package to send logs to console with extra info and catch query sql .

##### [Tutorial how create composer package](https://cirelramos.blogspot.com/2022/04/how-create-composer-package.html)


## Installation

Require the `cirelramos/logs` package in your `composer.json` and update your dependencies:
```sh
composer require cirelramos/logs
```


## Configuration

set provider and alias in app.php

```php
'providers' => [
    // ...
    Cirelramos\Logs\Providers\ServiceProvider::class,
],


'aliases' => [
    'LogConsole' => Cirelramos\Logs\Facades\LogConsoleFacade::class
]
```


The defaults are set in `config/logs.php`. Publish the config to copy the file to your own config:
```sh
php artisan vendor:publish --provider="Cirelramos\Logs\Providers\ServiceProvider"
```

> **Note:** this is necessary to you can change default config



## Usage

add provider in config/app.php

```php
    'providers' => [
        Cirelramos\Logs\Providers\QueryLogProvider::class,
   ]
```


## License

Released under the MIT License, see [LICENSE](LICENSE).


[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square

