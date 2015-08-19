<?php

namespace TMSolution\GamificationBundle\Tests;

use TMSolution\GamificationBundle\Entity\Objectinstance;
use TMSolution\GamificationBundle\Entity\Objecttype;
use ReflectionClass;

class ObjectinstanceTest extends \PHPUnit_Framework_TestCase {

    public function testGetId() {

        $objectinstance = new Objectinstance();
        $class = new ReflectionClass($objectinstance);
        $property = $class->getProperty('id');
        $property->setAccessible(true);
        $property->setValue($objectinstance, 1);
        $this->assertSame(1, $objectinstance->getId());
    }

    public function testObjectidentity() {

        $objidentity = new Objectinstance();
        $objidentityGet = $objidentity->setObjectidentity(2)->getObjectidentity();
        $this->assertTrue(2 == $objidentityGet);
    }

    public function testObjecttype() {

        $objectinstancetype = new Objectinstance();
        $objectType = new Objecttype();
        $objecttypeGet = $objectinstancetype->setObjecttype($objectType)->getObjecttype();
        $this->assertTrue($objectType == $objecttypeGet);
    }

}
