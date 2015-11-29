<?php

namespace TMSolution\GamificationBundle\Tests;

use TMSolution\GamificationBundle\Entity\GamificationEventcounter;
use TMSolution\GamificationBundle\Entity\Gamerinstance;
use TMSolution\GamificationBundle\Entity\GamificationEvent;
use ReflectionClass;

class GamificationEventcounterTest extends \PHPUnit_Framework_TestCase {

    public function testGetId() {

        $eventcounter = new GamificationEventcounter();
        $class = new ReflectionClass($eventcounter);
        $property = $class->getProperty('id');
        $property->setAccessible(true);
        $property->setValue($eventcounter, 1);
        $this->assertSame(1, $eventcounter->getId());
    }

    public function testCounter() {

        $counter = new GamificationEventcounter();
        $counterGet = $counter->setCounter(4)->getCounter();
        $this->assertTrue(4 == $counterGet);
    }

    public function testGamerinstance() {

        $gamerInstance = new GamificationEventcounter();
        $gamerInst = new Gamerinstance();
        $gamerInstanceGet = $gamerInstance->setGamerInstance($gamerInst)->getGamerInstance();
        $this->assertTrue($gamerInst == $gamerInstanceGet);
    }

    public function testGamificationEvent() {

        $event = new GamificationEventcounter();
        $ev = new GamificationEvent();
        $eventGet = $event->setGamificationEvent($ev)->getGamificationEvent();
        $this->assertTrue($ev == $eventGet);
    }

}
