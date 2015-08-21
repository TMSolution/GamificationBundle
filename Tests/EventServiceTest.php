<?php

/**
 * Test class for EventService
 *
 * @author Damian Piela
 * @author Lukasz
 */

namespace TMSolution\GamificationBundle\Tests;

class EventServiceTest extends \PHPUnit_Framework_TestCase {

    protected static $kernel;
    protected static $container;
    protected $objectinstanceModel;
    protected $trophyModel;
    protected $objectTrophyModel;
    protected $eventsService;
    protected $modelFactory;
    protected $gamificationModel;
    protected $objectEventcategoryModel;
    protected $objecttypeModel;
    protected $ruleModel;

    public static function setUpBeforeClass() {

        self::$kernel = new \AppKernel('test', true);
        self::$kernel->boot();
        self::$container = self::$kernel->getContainer();
    }

    public function setUp() {

        $this->modelFactory = $this->get('model_factory');
        $this->objectinstanceModel = $this->modelFactory->getModel('TMSolution\GamificationBundle\Entity\Objectinstance');
        $this->trophyModel = $this->modelFactory->getModel('TMSolution\GamificationBundle\Entity\Trophy');
        $this->objectTrophyModel = $this->modelFactory->getModel('TMSolution\GamificationBundle\Entity\Objecttrophy');
        $this->objectEventModel = $this->modelFactory->getModel('TMSolution\GamificationBundle\Entity\Event');
        $this->eventsService = $this->get('gamification.events');
        $this->objectEventcategoryModel = $this->modelFactory->getModel('TMSolution\GamificationBundle\Entity\Eventcategory');
        $this->objecttypeModel = $this->modelFactory->getModel('TMSolution\GamificationBundle\Entity\Objecttype');
        $this->ruleModel = $this->modelFactory->getModel('TMSolution\GamificationBundle\Entity\Rule');
    }

    public function get($serviceId) {
        return self::$kernel->getContainer()->get($serviceId);
    }

    public function testGetObjectTrophiesMock() {
        $mockobjecttrophy = $this->getMockBuilder('TMSolution\GamificationBundle\Entity\Objectinstance')
                ->getMock();
        $mockobjecttrophy->method('setObjectidentity')
                ->willReturn(1);
        $this->assertEquals(1, $mockobjecttrophy->setObjectidentity(1));
    }

    public function testSetObjecttypeMock() {

        $mockobjectinstance = $this->getMockBuilder('TMSolution\GamificationBundle\Entity\Objectinstance')
                ->getMock();
        $mockobjecttype = $this->getMockBuilder('TMSolution\GamificationBundle\Entity\Objecttype')
                ->getMock();
        $mockobjectinstance->method('setObjecttype')
                ->willReturn($mockobjecttype);

        $this->assertEquals($mockobjecttype, $mockobjectinstance->setObjecttype($mockobjecttype));
    }

    public function testaddObjectTrophyMock() {
        $mockobjecttrophy = $this->getMockBuilder('TMSolution\GamificationBundle\Entity\Objecttrophy')
                ->getMock();
        $mockobjecttrophy->method('setObject')
                ->willReturn(1);
        $mockobjecttrophy->method('setTrophy')
                ->willReturn(1);
        $this->assertEquals(1, $mockobjecttrophy->setObject());
        $this->assertEquals(1, $mockobjecttrophy->setTrophy());
    }

    public function testAddObjectTrophy() {
        $objectinstance = $this->objectinstanceModel->findOneById(1);
        $trophy = $this->trophyModel->findOneById(1);
        $objectTrophy = $this->eventsService->addObjectTrophy($objectinstance, $trophy);
        $query = $this->objectTrophyModel->getManager()->createQuery('SELECT MAX(u.id) id FROM TMSolution\GamificationBundle\Entity\Objecttrophy u');
        $max = $query->getSingleResult();
        $foundObjectTrophy = $this->objectTrophyModel->findOneById($max["id"]);
        $this->assertEquals($objectTrophy, $foundObjectTrophy);
    }

    public function testGetObjectTrophies() {
        $objecttrophy = $this->objectTrophyModel->findAll();
        $this->assertNotNull($objecttrophy);
    }

    /**
     * @author Damian Piela
     */
    //niekoniecznie typu "cyclic" - to zależy od ID w bazie 
    public function testCountCyclicTrophies() {
        $cyclicTrophy = $this->trophyModel->findOneById(1);
        $objectInstance = $this->objectinstanceModel->findOneById(1);
        $cyclicTrophies = $this->eventsService->countTrophies($objectInstance, $cyclicTrophy);
        $this->assertNotNull($cyclicTrophies);
    }

    /**
     * @author Damian Piela
     */
    public function testCreateObjecttrophy() {

        $objectInstance = $this->objectinstanceModel->findOneById(1);
        $trophy = $this->trophyModel->findOneById(1);
        $query = $this->objectTrophyModel->getManager()->createQuery('SELECT MAX(u.id) id FROM TMSolution\GamificationBundle\Entity\Objecttrophy u');
        $recordsBefore = $query->getSingleResult();


        $objectTrophy = $this->eventsService->createObjecttrophy($objectInstance, $trophy);
        if ($objectTrophy != null) {
            $recordsAfter = $query->getSingleResult();
            if($recordsAfter > $recordsBefore){
                $this->assertTrue(true);
            }
        } else {
            $this->assertTrue(false);
        }
    }

    /**
     * @author Damian Piela
     */
    public function testCountTrophies() {
        $objectInstance = $this->objectinstanceModel->findOneById(1);
        $trophy = $this->objectTrophyModel->findOneById(1);
        $count = $this->eventsService->countTrophies($objectInstance, $trophy);
        $this->assertInternalType("int", $count);
    }

    public function testRegister() {
        $eventcategoryObject = $this->objectEventcategoryModel->findOneById(1);
        $eventcategoryId = $eventcategoryObject->getId();
        $objectinstanceObject = $this->objectinstanceModel->findOneById(1);
        $objectidentity = $objectinstanceObject->getObjectidentity();
        $objecttype = $this->objecttypeModel->findOneById(1);
        $objecttypeId = $objecttype->getId();
        $result = $this->eventsService->register($eventcategoryId, $objectidentity, $objecttypeId);
        $this->assertNull($result);
    }

    public function testCheckRule() {
        $objecttrophy = $this->objectTrophyModel->findOneById(1);
        $object = $objecttrophy->getObject();
        $trophy = $objecttrophy->getTrophy();
        $rule = $this->eventsService->checkRule($object, $trophy);
        $this->assertNotNull($rule);
    }

    //---------------------test methods from Model/Objectinstance------------------------------

    public function testCheckInstance() {
        $objectinstanceModelFactory = $this->get('model_factory');
        $objinstmodel = $objectinstanceModelFactory->getModel('TMSolution\GamificationBundle\Entity\Objectinstance');
        $objectInstance = $this->objectinstanceModel->findOneById(1);
        $objectidentity = $objectInstance->getObjectidentity();
        $objecttype = $objectInstance->getObjecttype();
        $check = $objinstmodel->checkInstance($objectidentity, $objecttype);
        $this->assertNotNull($check);
    }

    public function testCreateInstance() {
        $objectinstanceModelFactory = $this->get('model_factory');
        $objinstmodel = $objectinstanceModelFactory->getModel('TMSolution\GamificationBundle\Entity\Objectinstance');
        $objectInstance = $this->objectinstanceModel->findOneById(1);
        $objectidentity = $objectInstance->getObjectidentity();
        $objectype = $objectInstance->getObjecttype();
        $create = $objinstmodel->createInstance($objectidentity, $objectype);
        $this->assertNotNull($create);
    }

    public function testGetInstance() {
        $objectinstanceModelFactory = $this->get('model_factory');
        $objinstmodel = $objectinstanceModelFactory->getModel('TMSolution\GamificationBundle\Entity\Objectinstance');
        $objectInstance = $this->objectinstanceModel->findOneById(1);
        $objectidentity = $objectInstance->getObjectidentity();
        $objectype = $objectInstance->getObjecttype();
        $result = $objinstmodel->getInstance($objectidentity, $objectype);
        $this->assertNotNull($result);
    }

    //---------------------------------------------------------------------------------------------------------------
}
