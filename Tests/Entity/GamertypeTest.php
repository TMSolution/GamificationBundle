<?php

namespace TMSolution\GamificationBundle\Tests\Entity;

use TMSolution\GamificationBundle\Entity\Gamertype;

/**
 * Description of GamertypeTest
 *
 * @author Damian Piela <damian.piela@tmsolution.pl>
 */
class GamertypeTest extends \PHPUnit_Framework_TestCase {

    public function testSetName() {
        $ot = new Gamertype();
        $ot->setName('Name');
        $this->assertEquals('Name', $ot->getName());
    }

    public function testGetName() {
        $ot = new Gamertype();
        $ot->setName('Name');
        $this->assertEquals('Name', $ot->getName());
    }

}
