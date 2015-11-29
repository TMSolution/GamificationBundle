<?php

namespace TMSolution\GamificationBundle\Tests;

use TMSolution\GamificationBundle\Entity\GamificationEventcategory;
use ReflectionClass;

class GamificationEventcategoryTest extends \PHPUnit_Framework_TestCase {

    public function testGetId() {

        $eventcategory = new GamificationEventcategory();
        $class = new ReflectionClass($eventcategory);
        $property = $class->getProperty('id');
        $property->setAccessible(true);
        $property->setValue($eventcategory, 1);
        $this->assertSame(1, $eventcategory->getId());
    }

    public function testName() {

        $name = new GamificationEventcategory();
        $nameGet = $name->setName('test')->getName();
        $this->assertTrue('test' == $nameGet);
    }

}
