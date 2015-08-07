<?php

namespace Refinery29\CS\Config;

use Symfony\CS\Config\Config;
use Symfony\CS\FixerInterface;

class Refinery29 extends Config
{
    public function getName()
    {
        return 'refinery29';
    }

    public function getDescription()
    {
        return 'The configuration for Refinery29 PHP applications';
    }

    public function getLevel()
    {
        return FixerInterface::PSR2_LEVEL;
    }

    public function usingCache()
    {
        return true;
    }

    public function usingLinter()
    {
        return true;
    }
}
