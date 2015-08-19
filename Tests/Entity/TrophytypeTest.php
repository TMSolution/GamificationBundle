<?php

namespace TMSolution\GamificationBundle\Tests\Entity;

use TMSolution\GamificationBundle\Entity\Trophytype;

/**
 * Description of TrophytypeTest
 *
 * @author Damian Piela <damian.piela@tmsolution.pl>
 */
class TrophytypeTest extends \PHPUnit_Framework_TestCase {

    public function testSetName() {
        $tt = new Trophytype();
        $tt->setName('Type1');
        $this->assertEquals('Type1', $tt->getName());
    }

    public function testGetName() {
        $tt = new Trophytype();
        $tt->setName('Type1');
        $this->assertEquals('Type1', $tt->getName());
    }

}
