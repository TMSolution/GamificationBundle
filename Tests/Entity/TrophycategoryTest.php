<?php

namespace TMSolution\GamificationBundle\Tests\Entity;

use TMSolution\GamificationBundle\Entity\Trophycategory;

/**
 * Description of TrophycategoryTest
 *
 * @author Damian Piela <damian.piela@tmsolution.pl>
 */
class TrophycategoryTest extends \PHPUnit_Framework_TestCase {

    public function testSetName() {
        $trCat = new Trophycategory();
        $trCat->setName('Kategoria1');
        $this->assertEquals('Kategoria1', $trCat->getName());
    }

    public function testGetName() {
        $trCat = new Trophycategory();
        $trCat->setName('Kategoria1');
        $this->assertEquals('Kategoria1', $trCat->getName());
    }
}
