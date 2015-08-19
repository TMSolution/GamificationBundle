<?php

namespace TMSolution\GamificationBundle\Tests;

use TMSolution\GamificationBundle\Entity\Eventlog;
use TMSolution\GamificationBundle\Entity\Event;
use TMSolution\GamificationBundle\Entity\Objectinstance;
use ReflectionClass;

class EventlogTest extends \PHPUnit_Framework_TestCase {

    public function testGetId() {

        $eventlog = new Eventlog();
        $class = new ReflectionClass($eventlog);
        $property = $class->getProperty('id');
        $property->setAccessible(true);
        $property->setValue($eventlog, 1);
        $this->assertSame(1, $eventlog->getId());
    }

    public function testObjectinstance() {

        $objectInstance = new Eventlog();
        $objectInst = new Objectinstance();
        $objectInstanceGet = $objectInstance->setObjectInstance($objectInst)->getObjectInstance();
        $this->assertTrue($objectInst == $objectInstanceGet);
    }

    public function testEvent() {

        $eventlog = new Eventlog();
        $event = new Event();
        $eventGet = $eventlog->setEvent($event)->getEvent();
        $this->assertTrue($event == $eventGet);
    }

}
