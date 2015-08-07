<?php

namespace Refinery29\CS\Config\Test;

use Refinery29\CS\Config\Refinery29;
use Symfony\CS\ConfigInterface;
use Symfony\CS\FixerInterface;

class Refinery29Test extends \PHPUnit_Framework_TestCase
{
    public function testImplementsInterface()
    {
        $config = new Refinery29();

        $this->assertInstanceOf(ConfigInterface::class, $config);
    }

    public function testValues()
    {
        $config = new Refinery29();

        $this->assertSame('refinery29', $config->getName());
        $this->assertSame('The configuration for Refinery29 PHP applications', $config->getDescription());
        $this->assertSame(FixerInterface::PSR2_LEVEL, $config->getLevel());
        $this->assertTrue($config->usingCache());
        $this->assertTrue($config->usingLinter());
    }
}
