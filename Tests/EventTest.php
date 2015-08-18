<?php

namespace TMSolution\GamificationBundle\Tests;

use TMSolution\GamificationBundle\Entity\Event;
use TMSolution\GamificationBundle\Entity\Eventcategory;
use ReflectionClass;

class EventTest extends \PHPUnit_Framework_TestCase {

    public function testGetId() {

        $event = new Event();
        $class = new ReflectionClass($event);
        $property = $class->getProperty('id');
        $property->setAccessible(true);
        $property->setValue($event, 1);
        $this->assertSame(1, $event->getId());
    }

    public function testName() {

        $name = new Event();
        $nameGet = $name->setName('test')->getName();
        $this->assertTrue('test' == $nameGet);
    }

    public function testEventcategoryid() {

        $eventcategoryid = new Event();
        $id = new Eventcategory();
        $eventcategoryidGet = $eventcategoryid->setEventcategoryid($id)->getEventcategoryid();
        $this->assertTrue($id == $eventcategoryidGet);
    }

}
