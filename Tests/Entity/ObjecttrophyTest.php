<?php

namespace TMSolution\GamificationBundle\Tests;

use TMSolution\GamificationBundle\Entity\Trophy;
use TMSolution\GamificationBundle\Entity\Objectinstance;
use TMSolution\GamificationBundle\Entity\Objecttrophy;
use ReflectionClass;

class EventTest extends \PHPUnit_Framework_TestCase {

    public function testGetId() {

        $objecttrophy = new Objecttrophy();
        $class = new ReflectionClass($objecttrophy);
        $property = $class->getProperty('id');
        $property->setAccessible(true);
        $property->setValue($objecttrophy, 1);
        $this->assertSame(1, $objecttrophy->getId());
    }

    public function testObject() {

        $object = new Objecttrophy();
        $objectid = new Objectinstance();
        $objectGet = $object->setObject($objectid)->getObject();
        $this->assertTrue($objectid == $objectGet);
    }

    public function testTrophy() {

        $object = new Objecttrophy();
        $trophy = new Trophy();
        $trophyGet = $object->setTrophy($trophy)->getTrophy();
        $this->assertTrue($trophy == $trophyGet);
    }

}
