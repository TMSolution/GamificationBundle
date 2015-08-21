<?php

/**
 * Loads test data to database
 * 
 * @author Damian Piela
 * @author Lukasz
 */

namespace TMSolution\GamificationBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use TMSolution\GamificationBundle\Entity\Context;
use TMSolution\GamificationBundle\Entity\Trophytype;
use TMSolution\GamificationBundle\Entity\Trophy;
use TMSolution\GamificationBundle\Entity\Trophycategory;
use TMSolution\GamificationBundle\Entity\Objectinstance;
use TMSolution\GamificationBundle\Entity\Objecttrophy;
use TMSolution\GamificationBundle\Entity\Rule;
use TMSolution\GamificationBundle\Entity\Event;
use TMSolution\GamificationBundle\Entity\Eventcategory;
use TMSolution\GamificationBundle\Entity\Eventcounter;
use TMSolution\GamificationBundle\Entity\Eventlog;
use TMSolution\GamificationBundle\Entity\Objecttype;
use Faker\Factory;
use Core\ModelBundle\Model\Model;

class LoadDataToDB extends AbstractFixture implements FixtureInterface {

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

        //Context - sc
        $context = new Context();
        $context->setName($faker->word);
        $manager->persist($context);
        $manager->flush();
        $this->addReference('context', $context);


        //Objecttype - sc
        $objectType = new Objecttype();
        $objectType->setName('objectType1');
        $manager->persist($objectType);
        $manager->flush();
        $this->addReference('objecttype', $objectType);


        //Trophytype - sc
        $trophyType = new Trophytype();
        $trophyType->setName('Jednorazowa');
        $trophyType1 = new Trophytype();
        $trophyType1->setName('Cykliczna');
        $manager->persist($trophyType);
        $manager->persist($trophyType1);
        $manager->flush();
        $this->addReference('trophytypeJednorazowa', $trophyType);
        $this->addReference('trophytypeCykliczna', $trophyType1);


        //Trophycategory -sc
        $trophyCategory = new Trophycategory();
        $trophyCategory->setName('Kategoria testowa');
        $manager->persist($trophyCategory);
        $manager->flush();
        $this->addReference('trophycategory', $trophyCategory);


        //Eventcategory -sc
        $eventcategory = new Eventcategory();
        $eventcategory->setName($faker->name);
        $manager->persist($eventcategory);
        $manager->flush();
        $this->addReference('eventcategory', $eventcategory);



        //Event - ob
        $event = new Event();
        $event->setEventcategoryid($this->getReference('eventcategory'))
                ->setName('evnetName');
        $manager->persist($event);
        $manager->flush();
        $this->addReference('event', $event);


        //Objectinstance - ob
        $objectInstance = new Objectinstance();
        $objectInstance->setObjecttype($this->getReference('objecttype'))
                ->setObjectidentity(1);
        $manager->persist($objectInstance);
        $manager->flush();
        $this->addReference('objectinstance', $objectInstance);


        //Eventcounter - ob
        $eventCounter = new Eventcounter();
        $eventCounter->setObjectInstance($this->getReference('objectinstance'))
                ->setEvent($this->getReference('event'))
                ->setCounter(1);
        $manager->persist($eventCounter);
        $manager->flush();


        //Eventlog - ob
        $eventLog = new Eventlog();
        $eventLog->setObjectInstance($this->getReference('objectinstance'))
                ->setEvent($this->getReference('event'))
                ->setDate(new \DateTime('NOW'));
        $manager->persist($eventLog);
        $manager->flush();


        //Trophy - ob
        $trophy = new Trophy();
        $trophy->setTrophycategory($this->getReference('trophycategory'))
                ->setTrophytype($this->getReference('trophytypeJednorazowa'))
                ->setName('TrophytypeName')
                ->setImage('Image');
        $manager->persist($trophy);
        $manager->flush();
        $this->addReference('trophy', $trophy);

        $trophy1 = new Trophy();
        $trophy1->setTrophycategory($this->getReference('trophycategory'))
                ->setTrophytype($this->getReference('trophytypeCykliczna'))
                ->setName('TrophytypeName')
                ->setImage('Image');
        $manager->persist($trophy1);
        $manager->flush();


        $trophyCyclic = new Trophy();
        $trophyCyclic->setTrophycategory($this->getReference('trophycategory'))
                ->setTrophytype($this->getReference('trophytypeJednorazowa'))
                ->setName('TrophytypeName')
                ->setImage('Image');
        $manager->persist($trophyCyclic);
        $manager->flush();


        //Objecttrophy - ob
        $objectTrophy = new Objecttrophy();
        $objectTrophy->setObject($this->getReference('objectinstance'))
                ->setTrophy($this->getReference('trophy'))
                ->setDate(new \DateTime('NOW'));
        $manager->persist($objectTrophy);
        $manager->flush();
//die('ok');
        //Rule - ob
        $rule = new Rule();
        $rule->setContext($this->getReference('context'))
                ->setTrophy($this->getReference('trophy'))
                ->setEvent($this->getReference('event'))
                ->setOperator('<')
                ->setValue('10');
        $manager->persist($rule);
        $manager->flush();



//$eventCategoryModel = $model->getModel('TMSolution\GamificationBundle\Entity\Eventcategory');
//        die('ok');
//        $eventCategoryDB = $eventCategoryModel->findOneById(1);
//        var_dump($eventCategoryDB);
//        
        //juz istnieje w LoadContext
        //context
//        $context = new Context();
//        $context->setName('contextTest');
//        $manager->persist($context);
//        $manager->flush();
        //rule
//        $rule = new Rule();
//        $rule->//setContext(new Context())
//                setOperator('>')
//                ->setValue('30');
//        $manager->persist($context);
//        $manager->flush();
//
//        //Objectinstance
//        $objectInstance = new Objectinstance();
//        $manager->persist($objectInstance);
//        $manager->flush();
//
//        //Trophy
//        $trophy = new Trophy();
//        $manager->persist($objectInstance);
//        $manager->flush();
//
//        //Objecttrophy
//        $objectTrophy = new Objecttrophy();
//        $manager->persist($objectInstance);
//        $manager->flush();
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
