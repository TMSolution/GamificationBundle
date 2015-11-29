<?php

namespace TMSolution\GamificationBundle\Tests\Entity;

use TMSolution\GamificationBundle\Entity\TrophyType;

/**
 * Description of TrophyTypeTest
 *
 * @author Damian Piela <damian.piela@tmsolution.pl>
 */
class TrophyTypeTest extends \PHPUnit_Framework_TestCase {

    public function testSetName() {
        $tt = new TrophyType();
        $tt->setName('Type1');
        $this->assertEquals('Type1', $tt->getName());
    }

    public function testGetName() {
        $tt = new TrophyType();
        $tt->setName('Type1');
        $this->assertEquals('Type1', $tt->getName());
    }

}
