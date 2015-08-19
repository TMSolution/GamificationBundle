<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoadContext
 *
 * @author Lukasz
 */

namespace TMSolution\GamificationBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use TMSolution\GamificationBundle\Entity\Context;
use TMSolution\GamificationBundle\Entity\Eventcategory;
use TMSolution\GamificationBundle\Entity\Eventcategory;
use TMSolution\GamificationBundle\Entity\Trophy;
use Faker\Factory;

class LoadContext implements FixtureInterface {

    public function load(ObjectManager $manager) {
        $faker = Factory::create();

        //load data to the context table
        for ($i = 0; $i < 10; $i++) {

            for ($i = 0; $i < 1000; $i++) {

                $context = new Context();
                $context->setName($faker->name);

                $manager->persist($context);
            }
            $manager->flush();
        }


        //load data to the eventcategory  table
        for ($i = 0; $i < 10; $i++) {

            for ($i = 0; $i < 1000; $i++) {

                $eventcategory = new Eventcategory();
                $eventcategory->setName($faker->name);

                $manager->persist($eventcategory);
            }
            $manager->flush();
        }
        
        
         //load data to the objecttrophy  table
        for ($i = 0; $i < 10; $i++) {

            for ($i = 0; $i < 1000; $i++) {

                $eventcategory = new Eventcategory();
                $eventcategory->setName($faker->name);

                $manager->persist($eventcategory);
            }
            $manager->flush();
        }
    }

}
