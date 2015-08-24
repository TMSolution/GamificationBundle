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
use Doctrine\Common\Persistence\GamerManager;
use TMSolution\GamificationBundle\Entity\Context;
use TMSolution\GamificationBundle\Entity\Trophytype;
use TMSolution\GamificationBundle\Entity\Trophy;
use TMSolution\GamificationBundle\Entity\Trophycategory;
use TMSolution\GamificationBundle\Entity\Gamerinstance;
use TMSolution\GamificationBundle\Entity\Gamertrophy;
use TMSolution\GamificationBundle\Entity\Rule;
use TMSolution\GamificationBundle\Entity\Event;
use TMSolution\GamificationBundle\Entity\Eventcategory;
use TMSolution\GamificationBundle\Entity\Eventcounter;
use TMSolution\GamificationBundle\Entity\Eventlog;
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

    public function load(GamerManager $manager) {

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


        //Trophycategory - sc
        $trophyCategory = new Trophycategory();
        $trophyCategory->setName('Kategoria testowa');
        $manager->persist($trophyCategory);
        $manager->flush();
        $this->addReference('trophycategory', $trophyCategory);


        //Eventcategory - sc
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


        //Gamerinstance - ob
        $gamerInstance = new Gamerinstance();
        $gamerInstance->setGamertype($this->getReference('gamertype'))
                ->setGameridentity(1);
        $manager->persist($gamerInstance);
        $manager->flush();
        $this->addReference('gamerinstance', $gamerInstance);


        //Eventcounter - ob
        $eventCounter = new Eventcounter();
        $eventCounter->setGamerInstance($this->getReference('gamerinstance'))
                ->setEvent($this->getReference('event'))
                ->setCounter(1);
        $manager->persist($eventCounter);
        $manager->flush();


        //Eventlog - ob
        $eventLog = new Eventlog();
        $eventLog->setGamerInstance($this->getReference('gamerinstance'))
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


        //Gamertrophy - ob
        $gamerTrophy = new Gamertrophy();
        $gamerTrophy->setGamerinstance($this->getReference('gamerinstance'))
                ->setTrophy($this->getReference('trophy'))
                ->setDate(new \DateTime('NOW'));
        $manager->persist($gamerTrophy);
        $manager->flush();

        
        //Rule - ob
        $rule = new Rule();
        $rule->setContext($this->getReference('context'))
                ->setTrophy($this->getReference('trophy'))
                ->setEvent($this->getReference('event'))
                ->setOperator('<')
                ->setValue('10');
        $manager->persist($rule);
        $manager->flush();

    }
}
