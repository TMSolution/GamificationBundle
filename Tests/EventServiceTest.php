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

class EventServiceTest extends \PHPUnit_Framework_TestCase {

    public function testGetObjectTrophies() {

        $mockobjecttrophy = $this->getMockBuilder('TMSolution\GamificationBundle\Entity\Objectinstance')
                ->getMock();


        $mockobjecttrophy->method('setObjectidentity')
                ->willReturn(1);


        $this->assertEquals(1, $mockobjecttrophy->setObjectidentity(1));
    }

    public function testSetObjecttype() {

        $mockobjecttrophy = $this->getMockBuilder('TMSolution\GamificationBundle\Entity\Objectinstance')
                ->getMock();
        $mockobjecttype = $this->getMockBuilder('TMSolution\GamificationBundle\Entity\Objecttype')
                ->getMock();
        $mockobjecttrophy->method('setObjecttype')
                ->willReturn($mockobjecttype);


        $this->assertEquals($mockobjecttype, $mockobjecttrophy->setObjecttype($mockobjecttype));
    }

}
