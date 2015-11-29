<?php

/**
 * Description of GamificationEventServiceTest
 *
 * @author Lukasz
 */

namespace TMSolution\GamificationBundle\Tests;

use TMSolution\GamificationBundle\Entity\Gamerinstance;
use TMSolution\GamificationBundle\Entity\TrophyCategory;
use TMSolution\GamificationBundle\Entity\Trophy;

class GamificationEventServiceTest extends \PHPUnit_Framework_TestCase {

    public function testGetGamerTrophies() {

        $mockgamertrophy = $this->getMockBuilder('TMSolution\GamificationBundle\Entity\Gamerinstance')
                ->getMock();


        $mockgamertrophy->method('setGameridentity')
                ->willReturn(1);


        $this->assertEquals(1, $mockgamertrophy->setGameridentity(1));
    }

    public function testSetGamertype() {

        $mockgamertrophy = $this->getMockBuilder('TMSolution\GamificationBundle\Entity\Gamerinstance')
                ->getMock();
        $mockgamertype = $this->getMockBuilder('TMSolution\GamificationBundle\Entity\Gamertype')
                ->getMock();
        $mockgamertrophy->method('setGamertype')
                ->willReturn($mockgamertype);


        $this->assertEquals($mockgamertype, $mockgamertrophy->setGamertype($mockgamertype));
    }

}
