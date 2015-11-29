<?php

namespace TMSolution\GamificationBundle\Tests;

use TMSolution\GamificationBundle\Entity\Trophy;
use TMSolution\GamificationBundle\Entity\Gamerinstance;
use TMSolution\GamificationBundle\Entity\Gamertrophy;
use ReflectionClass;

class GamificationEventTest extends \PHPUnit_Framework_TestCase {

    public function testGetId() {

        $gamertrophy = new Gamertrophy();
        $class = new ReflectionClass($gamertrophy);
        $property = $class->getProperty('id');
        $property->setAccessible(true);
        $property->setValue($gamertrophy, 1);
        $this->assertSame(1, $gamertrophy->getId());
    }

    public function testGamer() {

        $gamer = new Gamertrophy();
        $gamerid = new Gamerinstance();
        $gamerGet = $gamer->setGamer($gamerid)->getGamer();
        $this->assertTrue($gamerid == $gamerGet);
    }

    public function testTrophy() {

        $gamer = new Gamertrophy();
        $trophy = new Trophy();
        $trophyGet = $gamer->setTrophy($trophy)->getTrophy();
        $this->assertTrue($trophy == $trophyGet);
    }

}
