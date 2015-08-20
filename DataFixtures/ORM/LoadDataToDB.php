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
use TMSolution\GamificationBundle\Entity\Trophy;
use TMSolution\GamificationBundle\Entity\Trophycategory;
use TMSolution\GamificationBundle\Entity\Objectinstance;
use TMSolution\GamificationBundle\Entity\Objecttrophy;
use TMSolution\GamificationBundle\Entity\Rule;
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

        //context
        $context = new Context();
        $context->setName('contextTest');
        $manager->persist($context);
        $manager->flush();

        //rule
        //$contextDB = $model->getModel('TMSolution\GamificationBundle\Entity\Context')->findOneBy(['name' => 'contextTest']);
        //var_dump($contextDB);
        $rule = new Rule();
        $rule->//setContext(new Context())
                setOperator('>')
                ->setValue('30');
        $manager->persist($context);
        $manager->flush();

        //Objectinstance
        $objectInstance = new Objectinstance();
        $manager->persist($objectInstance);
        $manager->flush();

        //Trophy
        $trophy = new Trophy();
        $manager->persist($objectInstance);
        $manager->flush();

        //Objecttrophy
        $objectTrophy = new Objecttrophy();
        $manager->persist($objectInstance);
        $manager->flush();
        
        //Objectinstance

//        //Trophy
//        $trophyCategoryModel = $model->getModel('TMSolution\GamificationBundle\Entity\Trophycategory');
//        $trophyTypeModel = $model->getModel('TMSolution\GamificationBundle\Entity\Trophytype');
//
//        $trophyCategoryDB = $trophyCategoryModel->findOneBy(['name'=>'Kategoria testowa']);
//        $trophyTypeDB = $trophyTypeModel->findOneBy(['name'=>'Cykliczna']);
//
////        var_dump($trophyTypeDB);
////                die('ok');
//
//        $trophyModel = $model->getModel('TMSolution\GamificationBundle\Entity\Trophy');
//        //for ($i = 0; i < 10; $i++) {
//        $trophy = new Trophy();
//        $trophy ->setTrophycategory($trophyCategoryDB)
//                ->setTrophytype($trophyTypeDB)
//                ->setName('name')
//                ->setImage('image');
//        $trophyModel->create($trophy, true);
//        //$manager->persist($trophy);
//        // }
//        //$manager->flush();
//
//        die('ok');
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
