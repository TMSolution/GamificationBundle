<?php

namespace TMSolution\GamificationBundle\Tests\Entity;

use TMSolution\GamificationBundle\Entity\Rule;
use TMSolution\GamificationBundle\Entity\Trophy;
use TMSolution\GamificationBundle\Entity\Context;

/**
 * Description of RuleTest
 *
 * @author Damian Piela <damian.piela@tmsolution.pl>
 */
class RuleTest extends \PHPUnit_Framework_TestCase {

    public function testSetName() {
        $r = new Rule();
        $r->setName('Name');
        $this->assertEquals('Name', $r->getName());
    }

    public function testGetName() {
        $r = new Rule();
        $r->setName('Name');
        $this->assertEquals('Name', $r->getName());
    }

    public function testSetTrophy() {
        $r = new Rule();
        $tr = new Trophy();
        $r->setTrophy($tr);
        $this->assertEquals($tr, $r->getTrophy());
    }

    public function testGetTrophy() {
        $r = new Rule();
        $tr = new Trophy();
        $r->setTrophy($tr);
        $this->assertEquals($tr, $r->getTrophy());
    }

    public function testSetOperator() {
        $r = new Rule();
        $r->setOperator('operator');
        $this->assertEquals('operator', $r->getOperator());
    }

    public function testGetOperator() {
        $r = new Rule();
        $r->setOperator('operator');
        $this->assertEquals('operator', $r->getOperator());
    }

    public function testSetContext() {
        $r = new Rule();
        $c = new Context();
        $r->setContext($c);
        $this->assertEquals($c, $r->getContext());
    }

    public function testGetContext() {
        $r = new Rule();
        $c = new Context();
        $r->setContext($c);
        $this->assertEquals($c, $r->getContext());
    }

}
