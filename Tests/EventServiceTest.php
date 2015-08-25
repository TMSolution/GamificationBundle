<?php

/**
 * Test class for EventsService
 *
 * @author Damian Piela
 * @author Lukasz Sobieraj
 */

namespace TMSolution\GamificationBundle\Tests;

class EventServiceTest extends \PHPUnit_Framework_TestCase {

    protected static $kernel;
    protected static $container;
    protected $gamerinstanceModel;
    protected $trophyModel;
    protected $gamerTrophyModel;
    protected $eventsService;
    protected $modelFactory;
    protected $gamificationModel;
    protected $gamerEventcategoryModel;
    protected $gamertypeModel;
    protected $ruleModel;

    public static function setUpBeforeClass() {

        self::$kernel = new \AppKernel('test', true);
        self::$kernel->boot();
        self::$container = self::$kernel->getContainer();
    }

    public function setUp() {

        $this->modelFactory = $this->get('model_factory');
        $this->gamerinstanceModel = $this->modelFactory->getModel('TMSolution\GamificationBundle\Entity\Gamerinstance');
        $this->trophyModel = $this->modelFactory->getModel('TMSolution\GamificationBundle\Entity\Trophy');
        $this->gamerTrophyModel = $this->modelFactory->getModel('TMSolution\GamificationBundle\Entity\Gamertrophy');
        $this->gamerEventModel = $this->modelFactory->getModel('TMSolution\GamificationBundle\Entity\Event');
        $this->eventsService = $this->get('gamification.events');
        $this->gamerEventcategoryModel = $this->modelFactory->getModel('TMSolution\GamificationBundle\Entity\Eventcategory');
        $this->gamertypeModel = $this->modelFactory->getModel('TMSolution\GamificationBundle\Entity\Gamertype');
        $this->ruleModel = $this->modelFactory->getModel('TMSolution\GamificationBundle\Entity\Rule');
    }

    public function get($serviceId) {
        return self::$kernel->getContainer()->get($serviceId);
    }

    public function testGetGamerTrophiesMock() {
        $mockgamertrophy = $this->getMockBuilder('TMSolution\GamificationBundle\Entity\Gamerinstance')
                ->getMock();
        $mockgamertrophy->method('setGameridentity')
                ->willReturn(1);
        $this->assertEquals(1, $mockgamertrophy->setGameridentity(1));
    }

    public function testSetGamertypeMock() {

        $mockgamerinstance = $this->getMockBuilder('TMSolution\GamificationBundle\Entity\Gamerinstance')
                ->getMock();
        $mockgamertype = $this->getMockBuilder('TMSolution\GamificationBundle\Entity\Gamertype')
                ->getMock();
        $mockgamerinstance->method('setGamertype')
                ->willReturn($mockgamertype);

        $this->assertEquals($mockgamertype, $mockgamerinstance->setGamertype($mockgamertype));
    }

    public function testaddGamerTrophyMock() {
        $mockgamertrophy = $this->getMockBuilder('TMSolution\GamificationBundle\Entity\Gamertrophy')
                ->getMock();
        $mockgamertrophy->method('setGamerinstance')
                ->willReturn(1);
        $mockgamertrophy->method('setTrophy')
                ->willReturn(1);
        $this->assertEquals(1, $mockgamertrophy->setGamerinstance());
        $this->assertEquals(1, $mockgamertrophy->setTrophy());
    }
    
    public function testAddGamerTrophy() {
        $gamerinstance = $this->gamerinstanceModel->findOneById(1);
        $trophy = $this->trophyModel->findOneById(1);
        $gamerTrophy = $this->eventsService->addGamerTrophy($gamerinstance, $trophy);
        $query = $this->gamerTrophyModel->getManager()->createQuery('SELECT MAX(u.id) id FROM TMSolution\GamificationBundle\Entity\Gamertrophy u');
        $max = $query->getSingleResult();
        $foundGamerTrophy = $this->gamerTrophyModel->findOneById($max["id"]);
        $this->assertEquals($gamerTrophy, $foundGamerTrophy);
    }

    //do poprawy - wytestowac szczegolowo - ma sprawdzac ile obiektow zwrotka
    public function testGetGamerTrophies() {
        $gamertrophy = $this->gamerTrophyModel->findAll();
        $this->assertNotNull($gamertrophy);
    }

    //niekoniecznie typu "cyclic" - to zależy od ID w bazie 
    public function testCountCyclicTrophies() {
        $cyclicTrophy = $this->trophyModel->findOneById(1);
        $gamerInstance = $this->gamerinstanceModel->findOneById(1);
        $countcyclicTrophies = $this->eventsService->countTrophies($gamerInstance, $cyclicTrophy);
        $this->assertNotNull($countcyclicTrophies);
    }

    public function testCreateGamertrophy() {
        $gamerInstance = $this->gamerinstanceModel->findOneById(1);
        $trophy = $this->trophyModel->findOneById(1);
        $query = $this->gamerTrophyModel->getManager()->createQuery('SELECT MAX(u.id) id FROM TMSolution\GamificationBundle\Entity\Gamertrophy u');
        $recordsBefore = $query->getSingleResult();
        $gamerTrophy = $this->eventsService->createGamertrophy($gamerInstance, $trophy);
        if ($gamerTrophy != null) {
            $recordsAfter = $query->getSingleResult();
            if($recordsAfter > $recordsBefore){
                $this->assertTrue(true);
            }
        } else {
            $this->assertTrue(false);
        }
    }

    public function testCountTrophies() {
        $gamerInstance = $this->gamerinstanceModel->findOneById(1);
        $trophy = $this->gamerTrophyModel->findOneById(1);
        $count = $this->eventsService->countTrophies($gamerInstance, $trophy);
        $this->assertInternalType("int", $count);
    }

    public function testRegister() {
        $eventcategoryGamer = $this->gamerEventcategoryModel->findOneById(1);
        $eventcategoryId = $eventcategoryGamer->getId();
        $gamerinstanceGamer = $this->gamerinstanceModel->findOneById(1);
        $gameridentity = $gamerinstanceGamer->getGameridentity();
        $gamertype = $this->gamertypeModel->findOneById(1);
        $gamertypeId = $gamertype->getId();
        $result = $this->eventsService->register($eventcategoryId, $gameridentity, $gamertypeId);
        $this->assertNull($result);
    }

    public function testCheckRule() {
        $gamertrophy = $this->gamerTrophyModel->findOneById(1);
        $gamer = $gamertrophy->getGamerinstance();
        $trophy = $gamertrophy->getTrophy();
        $rule = $this->eventsService->checkRule($gamer, $trophy);
        $this->assertNotNull($rule);
    }

    //---------------------test methods from Model/Gamerinstance------------------------------

    public function testCheckInstance() {
        $gamerinstanceModelFactory = $this->get('model_factory');
        $objinstmodel = $gamerinstanceModelFactory->getModel('TMSolution\GamificationBundle\Entity\Gamerinstance');
        $gamerInstance = $this->gamerinstanceModel->findOneById(1);
        $gameridentity = $gamerInstance->getGameridentity();
        $gamertype = $gamerInstance->getGamertype();
        $check = $objinstmodel->checkInstance($gameridentity, $gamertype);
        $this->assertNotNull($check);
    }

    public function testCreateInstance() {
        $gamerinstanceModelFactory = $this->get('model_factory');
        $objinstmodel = $gamerinstanceModelFactory->getModel('TMSolution\GamificationBundle\Entity\Gamerinstance');
        $gamerInstance = $this->gamerinstanceModel->findOneById(1);
        $gameridentity = $gamerInstance->getGameridentity();
        $gamerype = $gamerInstance->getGamertype();
        $create = $objinstmodel->createInstance($gameridentity, $gamerype);
        $this->assertNotNull($create);
    }

    public function testGetInstance() {
        $gamerinstanceModelFactory = $this->get('model_factory');
        $objinstmodel = $gamerinstanceModelFactory->getModel('TMSolution\GamificationBundle\Entity\Gamerinstance');
        $gamerInstance = $this->gamerinstanceModel->findOneById(1);
        $gameridentity = $gamerInstance->getGameridentity();
        $gamerype = $gamerInstance->getGamertype();
        $result = $objinstmodel->getInstance($gameridentity, $gamerype);
        $this->assertNotNull($result);
    }

    //---------------------------------------------------------------------------------------------------------------
}
