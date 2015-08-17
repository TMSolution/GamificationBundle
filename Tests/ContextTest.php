<?php

namespace TMSolution\GamificationBundle\Tests;

use TMSolution\GamificationBundle\Entity\Context;
use ReflectionClass;

class ContextTest extends \PHPUnit_Framework_TestCase {

    public function testGetId() {

        $context = new Context();
        $class = new ReflectionClass($context);
        $property = $class->getProperty('id');
        $property->setAccessible(true);
        $property->setValue($context, 1);
        $this->assertSame(1, $context->getId());
    }

    public function testName() {

        $name = new Context();
        $nameGet = $name->setName('test')->getName();
        $this->assertTrue('test' == $nameGet);
    }

}
