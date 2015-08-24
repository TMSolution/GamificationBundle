<?php

namespace TMSolution\GamificationBundle\Tests;

use TMSolution\GamificationBundle\Entity\Gamerinstance;
use TMSolution\GamificationBundle\Entity\Gamertype;
use ReflectionClass;

class GamerinstanceTest extends \PHPUnit_Framework_TestCase {

    public function testGetId() {

        $gamerinstance = new Gamerinstance();
        $class = new ReflectionClass($gamerinstance);
        $property = $class->getProperty('id');
        $property->setAccessible(true);
        $property->setValue($gamerinstance, 1);
        $this->assertSame(1, $gamerinstance->getId());
    }

    public function testGameridentity() {

        $objidentity = new Gamerinstance();
        $objidentityGet = $objidentity->setGameridentity(2)->getGameridentity();
        $this->assertTrue(2 == $objidentityGet);
    }

    public function testGamertype() {

        $gamerinstancetype = new Gamerinstance();
        $gamerType = new Gamertype();
        $gamertypeGet = $gamerinstancetype->setGamertype($gamerType)->getGamertype();
        $this->assertTrue($gamerType == $gamertypeGet);
    }

}
