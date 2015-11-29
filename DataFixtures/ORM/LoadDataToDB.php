<?php

/**
 * Loads test data to database
 * 
 * @author Damian Piela
 * @author Lukasz Sobieraj
 */

namespace TMSolution\GamificationBundle\DataFixtures\ORM;

use Faker\Factory;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use TMSolution\GamificationBundle\Entity\Context;
use TMSolution\GamificationBundle\Entity\TrophyType;
use TMSolution\GamificationBundle\Entity\Trophy;
use TMSolution\GamificationBundle\Entity\TrophyCategory;
use TMSolution\GamificationBundle\Entity\Gamerinstance;
use TMSolution\GamificationBundle\Entity\Gamertrophy;
use TMSolution\GamificationBundle\Entity\Rule;
use TMSolution\GamificationBundle\Entity\GamificationEvent;
use TMSolution\GamificationBundle\Entity\GamificationEventcategory;
use TMSolution\GamificationBundle\Entity\GamificationEventcounter;
use TMSolution\GamificationBundle\Entity\GamificationEventlog;
use TMSolution\GamificationBundle\Entity\Gamertype;

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


        //Context - sc
        $context = new Context();
        $context->setName($faker->word);
        $manager->persist($context);
        $manager->flush();
        $this->addReference('context', $context);


        //Gamertype - sc
        $gamerType = new Gamertype();
        $gamerType->setName('gamerType1');
        $manager->persist($gamerType);
        $manager->flush();
        $this->addReference('gamertype', $gamerType);


        //TrophyType - sc
        $trophyType = new TrophyType();
        $trophyType->setName('Jednorazowa');
        $trophyType1 = new TrophyType();
        $trophyType1->setName('Cykliczna');
        $manager->persist($trophyType);
        $manager->persist($trophyType1);
        $manager->flush();
        $this->addReference('trophyTypeJednorazowa', $trophyType);
        $this->addReference('trophyTypeCykliczna', $trophyType1);


        //TrophyCategory - sc
        $trophyCategory = new TrophyCategory();
        $trophyCategory->setName('Kategoria testowa');
        $manager->persist($trophyCategory);
        $manager->flush();
        $this->addReference('trophyCategory', $trophyCategory);


        //GamificationEventcategory - sc
        $eventcategory = new GamificationEventcategory();
        $eventcategory->setName($faker->name);
        $manager->persist($eventcategory);
        $manager->flush();
        $this->addReference('eventcategory', $eventcategory);


        //GamificationEvent - ob
        $event = new GamificationEvent();
        $event->setGamificationEventcategoryid($this->getReference('eventcategory'))
                ->setName('evnetName');
        $manager->persist($event);
        $manager->flush();
        $this->addReference('event', $event);


        //Gamerinstance - ob
        $gamerInstance = new Gamerinstance();
        $gamerInstance->setGamertype($this->getReference('gamertype'))
                ->setGameridentity(1);
        $manager->persist($gamerInstance);
        $manager->flush();
        $this->addReference('gamerinstance', $gamerInstance);


        //GamificationEventcounter - ob
        $eventCounter = new GamificationEventcounter();
        $eventCounter->setGamerInstance($this->getReference('gamerinstance'))
                ->setGamificationEvent($this->getReference('event'))
                ->setCounter(1);
        $manager->persist($eventCounter);
        $manager->flush();


        //GamificationEventlog - ob
        $eventLog = new GamificationEventlog();
        $eventLog->setGamerInstance($this->getReference('gamerinstance'))
                ->setGamificationEvent($this->getReference('event'))
                ->setDate(new \DateTime('NOW'));
        $manager->persist($eventLog);
        $manager->flush();


        //Trophy - ob
        $trophy = new Trophy();
        $trophy->setTrophyCategory($this->getReference('trophyCategory'))
                ->setTrophyType($this->getReference('trophyTypeJednorazowa'))
                ->setName('TrophyTypeName')
                ->setImage('Image');
        $manager->persist($trophy);
        $manager->flush();
        $this->addReference('trophy', $trophy);

        $trophy1 = new Trophy();
        $trophy1->setTrophyCategory($this->getReference('trophyCategory'))
                ->setTrophyType($this->getReference('trophyTypeCykliczna'))
                ->setName('TrophyTypeName')
                ->setImage('Image');
        $manager->persist($trophy1);
        $manager->flush();
        $this->addReference('trophyCykliczna', $trophy1);


        //Gamertrophy - ob
        $gamerTrophy = new Gamertrophy();
        $gamerTrophy->setGamerinstance($this->getReference('gamerinstance'))
                ->setTrophy($this->getReference('trophy'))
                ->setDate(new \DateTime('NOW'))
                ->setTrophyCategory($this->getReference('trophyCategory'))
                ->setPosition(1);
        $manager->persist($gamerTrophy);
        $manager->flush();


        //Rule - ob
        $rule = new Rule();
        $rule->setContext($this->getReference('context'))
                ->setTrophy($this->getReference('trophy'))
                ->setGamificationEvent($this->getReference('event'))
                ->setOperator('<')
                ->setValue('10');
        $manager->persist($rule);
        $manager->flush();

        $rule = new Rule();
        $rule->setContext($this->getReference('context'))
                ->setTrophy($this->getReference('trophyCykliczna'))
                ->setGamificationEvent($this->getReference('event'))
                ->setOperator('<')
                ->setValue('10');
        $manager->persist($rule);
        $manager->flush();
        
        
        
        
        
        
        
        
        
        
    }

}
