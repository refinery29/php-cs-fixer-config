<?php

$header = <<<EOF
Copyright (c) 2016 Refinery29, Inc.

For the full copyright and license information, please view
the LICENSE file that was distributed with this source code.
EOF;

$config = new Refinery29\CS\Config\Refinery29($header);
$config->getFinder()->in(__DIR__);

$cacheDir = getenv('TRAVIS') ? getenv('HOME') . '/.php-cs-fixer' : __DIR__;

$config->setCacheFile($cacheDir . '/.php_cs.cache');

return $config;
