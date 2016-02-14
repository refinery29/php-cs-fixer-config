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
$ composer require --dev refinery29/php-cs-fixer-config
```

:exclamation: Since `fabpot/php-cs-fixer:2.0.x-dev` isn't stable, we're pinning the dependency to a known commit. 

There are two possibilities here
 
* you require that same commit in your repository

    ```
    $ composer require fabpot/php-cs-fixer-config:dev-master#47dd44c.
    ```

* you configure `composer.json` in your root package with

    ```json
    {
        "minimum-stability": "dev",
        "prefer-stable": true
    }
    ```
  and remove `fabpot/php-cs-fixer` with
  
    ```
    $ composer remove fabpot/php-cs-fixer
    ```
  trusting us to pull in a working version.
  
For reference, see [`fabpot/php-cs-fixer-config:dev-master#47dd44c`](https://github.com/FriendsOfPHP/PHP-CS-Fixer/commit/47dd44c).
  
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

:bulb: Optionally, you can specify a header comment to use, which will automatically enable the `header_comment` fixer:

```php
$header = <<<EOF
Copyright (c) 2016 Refinery29, Inc.

For the full copyright and license information, please view
the LICENSE file that was distributed with this source code.
EOF;

$config = new Refinery29\CS\Config\Refinery29($header);
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
  - vendor/bin/php-cs-fixer fix --config=.php_cs --verbose --diff --dry-run
```

If you only want to run `php-cs-fixer` on one PHP version, update your build matrix and use a condition:

```yml
matrix:
  include:
    - php: 5.5
      env: WITH_CS=true
    - php: 5.6
      env: WITH_COVERAGE=true
      
script:
  - if [[ "$WITH_CS" == "true" ]]; then vendor/bin/php-cs-fixer fix --config=.php_cs --verbose --diff --dry-run; fi
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

### Manually

If you need to fix issues locally, just run

```
$ make cs
```

### Pre-commit hook

You can add a `pre-commit` hook

```
$ touch .git/pre-commit && chmod +x .git/pre-commit
```

Paste this into `.git/pre-commit`:


```bash
#!/usr/bin/env bash

echo "pre commit hook start"

CURRENT_DIRECTORY=`pwd`
GIT_HOOKS_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

PROJECT_DIRECTORY="$GIT_HOOKS_DIR/../.."

cd $PROJECT_DIRECTORY;
PHP_CS_FIXER="vendor/bin/php-cs-fixer"

HAS_PHP_CS_FIXER=false

if [ -x "$PHP_CS_FIXER" ]; then
    HAS_PHP_CS_FIXER=true
fi

if $HAS_PHP_CS_FIXER; then
    git status --porcelain | grep -e '^[AM]\(.*\).php$' | cut -c 3- | while read line; do
        ${PHP_CS_FIXER} fix --config-file=.php_cs --verbose ${line};
        git add "$line";
    done
else
    echo ""
    echo "Please install php-cs-fixer, e.g.:"
    echo ""
    echo "  composer require --dev fabpot/php-cs-fixer:dev-master"
    echo ""
fi

cd $CURRENT_DIRECTORY;
echo "pre commit hook finish"
```

:bulb: See https://gist.github.com/jwage/c4ef1dcb95007b5be0da by [@jwage](http://github.com/jwage) (adjusted by [@rcatlin](http://github.com/rcatlin) for [@refinery29](http://github.com/refinery29)).

## License

This package is licensed using the MIT License.
