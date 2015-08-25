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
    protected $trophyTypeModel;
    protected $eventCounterModel;

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
        $this->trophyTypeModel = $this->modelFactory->getModel('TMSolution\GamificationBundle\Entity\Trophytype');
        $this->eventCounterModel = $this->modelFactory->getModel('TMSolution\GamificationBundle\Entity\Eventcounter');
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
        $mockgamertrophy->method('getGamerinstance')
                ->willReturn(1);
        $mockgamertrophy->method('getTrophy')
                ->willReturn(1);
        $this->assertEquals(1, $mockgamertrophy->getGamerinstance());
        $this->assertEquals(1, $mockgamertrophy->getTrophy());
    }

    public function testAddGamerTrophy() {
        $gamerInstance = $this->gamerinstanceModel->findOneById(1);
        $trophy = $this->trophyModel->findOneById(1);
        $gamerTrophy = $this->eventsService->addGamerTrophy($gamerInstance, $trophy);
        $query = $this->gamerTrophyModel->getManager()->createQuery('SELECT MAX(u.id) id FROM TMSolution\GamificationBundle\Entity\Gamertrophy u');
        $max = $query->getSingleResult();
        $foundGamerTrophy = $this->gamerTrophyModel->findOneById($max["id"]);
        $this->assertEquals($gamerTrophy, $foundGamerTrophy);
    }

    //do poprawy - wytestowac szczegolowo - ma sprawdza ile obiketow zwrotkaa
    public function testGetGamerTrophies() {
        //Counting user's (id=1) trophies
        $gamerInstance = $this->gamerinstanceModel->findOneById(1);
        $beforeAddingTrophy = count($this->gamerTrophyModel->findBy(['gamerinstance' => $gamerInstance]));

        //Adding one trophy for the user
        $trophy = $this->trophyModel->findOneById(1);
        $this->eventsService->addGamerTrophy($gamerInstance, $trophy);

        //Finding all of the user's trophies - count should be bigger by 1
        $afterAddingTrophy = count($this->gamerTrophyModel->findBy(['gamerinstance' => $gamerInstance]));

        //Asserting that the second check is greater by 1
        $this->assertEquals($beforeAddingTrophy + 1, $afterAddingTrophy);
    }

    //niekoniecznie typu "cyclic" - to zależy od ID w bazie 
    public function testCountCyclicTrophies() {

        //Check if the method can properly count trophies for the specified gamer
        $gamerInstance = $this->gamerinstanceModel->findOneById(1);
        $countCyclicTrophies = $this->eventsService->countCyclicTrophies($gamerInstance);
        $this->assertTrue(is_int($countCyclicTrophies));

        //Add one additional cyclic trophy
        $cyclicType = $this->trophyTypeModel->findOneById(2);
        $cyclicTrophy = $this->trophyModel->findOneBy(['trophytype' => $cyclicType]);
        $this->eventsService->addGamerTrophy($gamerInstance, $cyclicTrophy);

        //Make sure that the number of trophies the method counts has increased by 1
        $countCyclicAgain = $this->eventsService->countCyclicTrophies($gamerInstance);
        $this->assertEquals($countCyclicTrophies + 1, $countCyclicAgain);
    }

    public function testCreateGamertrophy() {
        $gamerInstance = $this->gamerinstanceModel->findOneById(1);
        $trophy = $this->trophyModel->findOneById(1);
        $query = $this->gamerTrophyModel->getManager()->createQuery('SELECT MAX(u.id) id FROM TMSolution\GamificationBundle\Entity\Gamertrophy u');
        $recordsBefore = $query->getSingleResult();
        $gamerTrophy = $this->eventsService->createGamertrophy($gamerInstance, $trophy);
        if ($gamerTrophy != null) {
            $recordsAfter = $query->getSingleResult();
            if ($recordsAfter > $recordsBefore) {
                $this->assertTrue(true);
            }
        } else {
            $this->assertTrue(false);
        }
    }

    public function testCountTrophies() {
        //Find trophies(of a certain type) for the specified user and make sure that the number is an integer, and not null
        $gamerInstance = $this->gamerinstanceModel->findOneById(1);
        $trophy = $this->trophyModel->findOneById(1);
        $count = $this->eventsService->countTrophies($gamerInstance, $trophy);
        $this->assertInternalType("int", $count);

        //Add one more Gamertrophy for the user and count the quantity again
        $this->eventsService->addGamerTrophy($gamerInstance, $trophy);
        $countAgain = $this->eventsService->countTrophies($gamerInstance, $trophy);

        //Make sure that the number of the trophies of this type for the specified user has indeed increased
        $this->assertEquals($count + 1, $countAgain);
    }

    public function testRegister() {

        //Get appropriate Eventcategory, Gamerinstance and Gamertype
        $eventcategoryGamer = $this->gamerEventcategoryModel->findOneById(1);
        $eventcategoryId = $eventcategoryGamer->getId();
        $gamerInstance = $this->gamerinstanceModel->findOneById(1);
        $gameridentity = $gamerInstance->getGameridentity();
        $gamertype = $this->gamertypeModel->findOneById(1);
        $gamertypeId = $gamertype->getId();

        //Check the Eventcounter for the appropriate user
        $eventCounter = $this->eventCounterModel->findOneBy(['gamerinstance' => $gamerInstance]);
        $counterBefore = $eventCounter->getCounter();

        //Register a new event for the specified user
        $this->eventsService->register($eventcategoryId, $gameridentity, $gamertypeId);

        //Make sure that the counter increased
        $eventCounter1 = $this->eventCounterModel->findOneBy(['gamerinstance' => $gamerInstance]);

        $counterAfter = $eventCounter1->getCounter();

        $this->assertEquals($counterBefore+1, $counterAfter);

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
