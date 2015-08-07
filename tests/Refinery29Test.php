<?php

namespace Refinery29\CS\Config\Test;

use Refinery29\CS\Config\Refinery29;

class Refinery29Test extends \PHPUnit_Framework_TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists(Refinery29::class));
    }
}
