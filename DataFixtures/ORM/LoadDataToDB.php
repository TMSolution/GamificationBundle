<?php

/**
 * Loads test data to database
 * 
 * @author Damian Piela
 * @author Lukasz
 */

namespace TMSolution\GamificationBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use TMSolution\GamificationBundle\Entity\Context;
use TMSolution\GamificationBundle\Entity\Trophytype;
use TMSolution\GamificationBundle\Entity\Trophycategory;
use Faker\Factory;
use Core\ModelBundle\Model\Model;

class LoadDataToDB implements FixtureInterface {

    protected static $kernel;
    protected static $container;

    public function __construct() {
        self::$kernel = new \AppKernel('test', true);
        self::$kernel->boot();
        self::$container = self::$kernel->getContainer();
    }

    public function get($serviceId) {
        return self::$kernel->getContainer()->get($serviceId);
    }

    public function load(ObjectManager $manager) {



        //Faker
        $faker = Factory::create();
        $model = $this->get('model_factory');
        //Trophytype
        $trophyType = new Trophytype();
        $trophyType->setName('Jednorazowa');
        $trophyType1 = new Trophytype();
        $trophyType1->setName('Cykliczna');
        $manager->persist($trophyType);
        $manager->persist($trophyType1);
        $manager->flush();




        //Trophycategory
        $trophyCategory = new Trophycategory();
        $trophyCategory->setName('Kategoria testowa');
        $manager->persist($trophyCategory);
        $manager->flush();
        
//
//
//        //Trophy
//        $trophyCategoryModel = $model->getModel('TMSolution\GamificationBundle\Entity\Trophycategory');
//        $trophyTypeModel = $model->getModel('TMSolution\GamificationBundle\Entity\Trophytype');
//        $randTrophyType = rand(1, 2);
//
//        for ($i = 0; i < 10; $i++) {
//            $trophy = new Trophy();
//            $trophy->setName($faker->word)
//                    ->setImage($faker->ipv6)
//                    ->setTrophycategory($trophyCategoryModel->findOneById(1))
//                    ->setTrophytype($trophyTypeModel->findOneById($randTrophyType));
//            $manager->persist($trophy);
//        }
//        $manager->flush();
//
//        
//        
//        
//
//        for ($i = 0; $i < 10; $i++) {
//
//            for ($i = 0; $i < 1000; $i++) {
//
//                $context = new Context();
//                $context->setName($faker->name);
//
//                $manager->persist($context);
//            }
//            $manager->flush();
//        }
    }

}
