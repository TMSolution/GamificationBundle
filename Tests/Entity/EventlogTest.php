<?php

namespace TMSolution\GamificationBundle\Tests;

use TMSolution\GamificationBundle\Entity\GamificationEventlog;
use TMSolution\GamificationBundle\Entity\GamificationEvent;
use TMSolution\GamificationBundle\Entity\Gamerinstance;
use ReflectionClass;

class GamificationEventlogTest extends \PHPUnit_Framework_TestCase {

    public function testGetId() {

        $eventlog = new GamificationEventlog();
        $class = new ReflectionClass($eventlog);
        $property = $class->getProperty('id');
        $property->setAccessible(true);
        $property->setValue($eventlog, 1);
        $this->assertSame(1, $eventlog->getId());
    }

    public function testGamerinstance() {

        $gamerInstance = new GamificationEventlog();
        $gamerInst = new Gamerinstance();
        $gamerInstanceGet = $gamerInstance->setGamerInstance($gamerInst)->getGamerInstance();
        $this->assertTrue($gamerInst == $gamerInstanceGet);
    }

    public function testGamificationEvent() {

        $eventlog = new GamificationEventlog();
        $event = new GamificationEvent();
        $eventGet = $eventlog->setGamificationEvent($event)->getGamificationEvent();
        $this->assertTrue($event == $eventGet);
    }

}
