<?php

/**
 * Description of EventServiceTest
 *
 * @author Lukasz
 */

namespace TMSolution\GamificationBundle\Tests;

use TMSolution\GamificationBundle\Entity\Objectinstance;
use TMSolution\GamificationBundle\Entity\Trophycategory;
use TMSolution\GamificationBundle\Entity\Trophy;
use TMSolution\GamificationBundle\Entity\Objecttrophy;

class EventServiceTest extends \PHPUnit_Framework_TestCase {

    public function testGetObjectTrophies() {

        $mockobjecttrophy = $this->getMockBuilder('TMSolution\GamificationBundle\Entity\Objectinstance')
                ->getMock();


        $mockobjecttrophy->method('setObjectidentity')
                ->willReturn(1);


        $this->assertEquals(1, $mockobjecttrophy->setObjectidentity(1));
    }

    public function testSetObjecttype() {

        $mockobjectinstance = $this->getMockBuilder('TMSolution\GamificationBundle\Entity\Objectinstance')
                ->getMock();
        $mockobjecttype = $this->getMockBuilder('TMSolution\GamificationBundle\Entity\Objecttype')
                ->getMock();
        $mockobjectinstance->method('setObjecttype')
                ->willReturn($mockobjecttype);

        $this->assertEquals($mockobjecttype, $mockobjectinstance->setObjecttype($mockobjecttype));
    }

    public function testaddObjectTrophy() {

        $mockobjecttrophy = $this->getMockBuilder('TMSolution\GamificationBundle\Entity\Objecttrophy')
                ->getMock();
        $mockobjecttrophy->method('setObject')
                ->willReturn(1);

        $mockobjecttrophy->method('setTrophy')
                ->willReturn(1);


        $this->assertEquals(1, $mockobjecttrophy->setObject());
        $this->assertEquals(1, $mockobjecttrophy->setTrophy());
    }

   

}
