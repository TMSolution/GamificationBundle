<?php

namespace TMSolution\GamificationBundle\Tests\Entity;

use TMSolution\GamificationBundle\Entity\Trophy;
use TMSolution\GamificationBundle\Entity\TrophyCategory;
use TMSolution\GamificationBundle\Entity\TrophyType;

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

    public function testSetTrophyCategory() {
        $tc = new TrophyCategory();
        $tr = new Trophy();
        $tr->setTrophyCategory($tc);
        $this->assertEquals($tc, $tr->getTrophyCategory());
    }

    public function testGetTrophyCategory() {
        $tc = new TrophyCategory();
        $tr = new Trophy();
        $tr->setTrophyCategory($tc);
        $this->assertSame($tc, $tr->getTrophyCategory());
    }

    public function testSetTrophyType() {
        $tt = new TrophyType();
        $tr = new Trophy();
        $tr->setTrophyType($tt);
        $this->assertEquals($tt, $tr->getTrophyType());
    }

    public function testGetTrophyType() {
        $tt = new TrophyType();
        $tr = new Trophy();
        $tr->setTrophyType($tt);
        $this->assertEquals($tt, $tr->getTrophyType());
    }

}
