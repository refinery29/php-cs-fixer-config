# php-cs-fixer-config

[![Build Status](https://travis-ci.org/refinery29/php-cs-fixer-config.svg?branch=master)](https://travis-ci.org/refinery29/php-cs-fixer-config)
[![Code Climate](https://codeclimate.com/github/refinery29/php-cs-fixer-config/badges/gpa.svg)](https://codeclimate.com/github/refinery29/php-cs-fixer-config)
[![Test Coverage](https://codeclimate.com/github/refinery29/php-cs-fixer-config/badges/coverage.svg)](https://codeclimate.com/github/refinery29/php-cs-fixer-config/coverage)
[![Dependency Status](https://www.versioneye.com/user/projects/55c51d1465376200200034bd/badge.svg?style=flat)](https://www.versioneye.com/user/projects/55c51d1465376200200034bd)

This repository provides a configuration for [`fabpot/php-cs-fixer`](http://github.com/FriendsOfPHP/PHP-CS-Fixer), which 
we use to verify and enforce a single coding standard for PHP code within Refinery29.

## Installation

Run

```
$ composer require --dev "fabpot/php-cs-fixer:2.0.*@dev"
$ composer require --dev refinery29/php-cs-fixer-config
```

## Usage

### Configuration

Create a configuration file `.php_cs` in the root of your project:

```php
<?php

$config = new Refinery29\CS\Config\Refinery29();
$config->getFinder()->in(__DIR__);

$cacheDir = getenv('TRAVIS') ? getenv('HOME') . '/.php-cs-fixer' : __DIR__;

$config->setCacheFile($cacheDir . '/.php_cs.cache');

return $config;
```

### Git

Add `.php_cs.cache` (this is the cache file created by `php-cs-fixer`) to `.gitignore`:

```
vendor/
.php_cs.cache
```

### Travis

Update your `.travis.yml` to cache the `php_cs.cache` file:

```yml
cache:
  directories:
    - $HOME/.composer/cache
```

Then run `php-cs-fixer` in the `script` section:

```yml
script:
  - vendor/bin/php-cs-fixer fix --config-file=.php_cs --verbose --diff --dry-run
```

If you only want to run `php-cs-fixer` on one PHP version, update your build matrix and use a condition:

```yml
matrix:
  include:
    - php: 5.4
    - php: 5.5
    - php: 5.6
      env: CHECK_CS=true
      
script:
  - if [[ "$CHECK_CS" == "true" ]]; then vendor/bin/php-cs-fixer fix --config-file=.php_cs --verbose --diff --dry-run; fi
```

### Makefile

Create a `Makefile` with a `composer` (because we're lazy) and a `cs` target:

```Makefile
composer:
	composer validate
	composer install

cs: composer
	vendor/bin/php-cs-fixer fix --config-file=.php_cs --verbose --diff
```

## Fixing issues

If you need to fix issues locally, just run

```
$ make cs
```
