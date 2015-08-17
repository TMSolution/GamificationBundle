<?php

namespace TMSolution\GamificationBundle\Tests;

use TMSolution\GamificationBundle\Entity\Eventcategory;
use ReflectionClass;

class EventcategoryTest extends \PHPUnit_Framework_TestCase {

    public function testGetId() {

        $eventcategory = new Eventcategory();
        $class = new ReflectionClass($eventcategory);
        $property = $class->getProperty('id');
        $property->setAccessible(true);
        $property->setValue($eventcategory, 1);
        $this->assertSame(1, $eventcategory->getId());
    }

    public function testName() {

        $name = new Eventcategory();
        $nameGet = $name->setName('test')->getName();
        $this->assertTrue('test' == $nameGet);
    }

}
