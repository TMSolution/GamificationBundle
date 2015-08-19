<?php

namespace TMSolution\GamificationBundle\Tests;

use TMSolution\GamificationBundle\Entity\Eventcounter;
use TMSolution\GamificationBundle\Entity\Objectinstance;
use TMSolution\GamificationBundle\Entity\Event;
use ReflectionClass;

class EventcounterTest extends \PHPUnit_Framework_TestCase {

    public function testGetId() {

        $eventcounter = new Eventcounter();
        $class = new ReflectionClass($eventcounter);
        $property = $class->getProperty('id');
        $property->setAccessible(true);
        $property->setValue($eventcounter, 1);
        $this->assertSame(1, $eventcounter->getId());
    }

    public function testCounter() {

        $counter = new Eventcounter();
        $counterGet = $counter->setCounter(4)->getCounter();
        $this->assertTrue(4 == $counterGet);
    }

    public function testObjectinstance() {

        $objectInstance = new Eventcounter();
        $objectInst = new Objectinstance();
        $objectInstanceGet = $objectInstance->setObjectInstance($objectInst)->getObjectInstance();
        $this->assertTrue($objectInst == $objectInstanceGet);
    }

    public function testEvent() {

        $event = new Eventcounter();
        $ev = new Event();
        $eventGet = $event->setEvent($ev)->getEvent();
        $this->assertTrue($ev == $eventGet);
    }

}
