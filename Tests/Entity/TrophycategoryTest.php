<?php

namespace TMSolution\GamificationBundle\Tests\Entity;

use TMSolution\GamificationBundle\Entity\TrophyCategory;

/**
 * Description of TrophyCategoryTest
 *
 * @author Damian Piela <damian.piela@tmsolution.pl>
 */
class TrophyCategoryTest extends \PHPUnit_Framework_TestCase {

    public function testSetName() {
        $trCat = new TrophyCategory();
        $trCat->setName('Kategoria1');
        $this->assertEquals('Kategoria1', $trCat->getName());
    }

    public function testGetName() {
        $trCat = new TrophyCategory();
        $trCat->setName('Kategoria1');
        $this->assertEquals('Kategoria1', $trCat->getName());
    }
}
