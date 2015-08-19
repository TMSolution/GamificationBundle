<?php

namespace TMSolution\GamificationBundle\Tests\Entity;

use TMSolution\GamificationBundle\Entity\Trophy;
use TMSolution\GamificationBundle\Entity\Trophycategory;
use TMSolution\GamificationBundle\Entity\Trophytype;

/**
 * Description of TrophyTest
 *
 * @author Damian Piela <damian.piela@tmsolution.pl>
 */
class TrophyTest extends \PHPUnit_Framework_TestCase {

    public function testSetName() {
        $tr = new Trophy();
        $tr->setName('Trophy');
        $this->assertEquals('Trophy', $tr->getName());
    }

    public function testGetName() {
        $tr = new Trophy();
        $tr->setName('Trophy');
        $this->assertEquals('Trophy', $tr->getName());
    }

    public function testSetImage() {
        $tr = new Trophy();
        $tr->setImage('Serialized Image');
        $this->assertEquals('Serialized Image', $tr->getImage());
    }

    public function testGetImage() {
        $tr = new Trophy();
        $tr->setImage('Serialized Image');
        $this->assertEquals('Serialized Image', $tr->getImage());
    }

    public function testSetTrophycategory() {
        $tc = new Trophycategory();
        $tr = new Trophy();
        $tr->setTrophycategory($tc);
        $this->assertEquals($tc, $tr->getTrophycategory());
    }

    public function testGetTrophycategory() {
        $tc = new Trophycategory();
        $tr = new Trophy();
        $tr->setTrophycategory($tc);
        $this->assertSame($tc, $tr->getTrophycategory());
    }

    public function testSetTrophytype() {
        $tt = new Trophytype();
        $tr = new Trophy();
        $tr->setTrophytype($tt);
        $this->assertEquals($tt, $tr->getTrophytype());
    }

    public function testGetTrophytype() {
        $tt = new Trophytype();
        $tr = new Trophy();
        $tr->setTrophytype($tt);
        $this->assertEquals($tt, $tr->getTrophytype());
    }

}
