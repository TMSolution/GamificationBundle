<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoadDataToDB
 *
 * @author Lukasz
 */

namespace TMSolution\GamificationBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use TMSolution\GamificationBundle\Entity\Context;
use Faker\Factory;

class LoadDataToDB implements FixtureInterface {

    //put your code here
    public function load(ObjectManager $manager) {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {

            for ($i = 0; $i < 1000; $i++) {

                $context = new Context();
                $context->setName($faker->name);

                $manager->persist($context);
            }
            $manager->flush();
        }
    }

}


