<?php

namespace TMSolution\GamificationBundle\Tests;

use TMSolution\GamificationBundle\Entity\GamificationEvent;
use TMSolution\GamificationBundle\Entity\GamificationEventcategory;
use ReflectionClass;

class GamificationEventTest extends \PHPUnit_Framework_TestCase {

    public function testGetId() {

        $event = new GamificationEvent();
        $class = new ReflectionClass($event);
        $property = $class->getProperty('id');
        $property->setAccessible(true);
        $property->setValue($event, 1);
        $this->assertSame(1, $event->getId());
    }

    public function testName() {

        $name = new GamificationEvent();
        $nameGet = $name->setName('test')->getName();
        $this->assertTrue('test' == $nameGet);
    }

    public function testGamificationEventcategoryid() {

        $eventcategoryid = new GamificationEvent();
        $id = new GamificationEventcategory();
        $eventcategoryidGet = $eventcategoryid->setGamificationEventcategoryid($id)->getGamificationEventcategoryid();
        $this->assertTrue($id == $eventcategoryidGet);
    }

}
