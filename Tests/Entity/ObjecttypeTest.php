<?php

namespace TMSolution\GamificationBundle\Tests\Entity;

use TMSolution\GamificationBundle\Entity\Objecttype;

/**
 * Description of ObjecttypeTest
 *
 * @author Damian Piela <damian.piela@tmsolution.pl>
 */
class ObjecttypeTest extends \PHPUnit_Framework_TestCase {

    public function testSetName() {
        $ot = new Objecttype();
        $ot->setName('Name');
        $this->assertEquals('Name', $ot->getName());
    }

    public function testGetName() {
        $ot = new Objecttype();
        $ot->setName('Name');
        $this->assertEquals('Name', $ot->getName());
    }

}
