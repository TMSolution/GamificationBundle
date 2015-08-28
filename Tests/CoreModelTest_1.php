<?php

/**
 * Tests function of class Model from ModelBundle
 *
 * @author Damian Piela <damian.piela@tmsolution.pl>
 */

namespace TMSolution\GamificationBundle\Tests;

use \TMSolution\GamificationBundle\Entity\Trophytype;
use Doctrine\Common\Collections\ArrayCollection;

class CoreModelTest_1 extends \PHPUnit_Framework_TestCase {
    /*
     * create($entityObject, $executeImmediately = false, $logOperation = false)
     * delete($entityObject, $executeImmediately = false, $logOperation = false)
     * update($entityObject, $executeImmediately = false, $logOperation = false)
     * findOneBy($array)
     * checkPropertyByName($propertyName)
     * testCoreModelGetFieldsInfo()
     * createEntities(ArrayCollection $arrayCollection, $executeImmediately = false)
     */

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

    public function testCoreModelCreate() {
// Create a unique identifier
        $stringIdentifier = "aVeryUniqueName";

//Create the appropriate entity object
        $trophyType = new Trophytype();
        $trophyType->setName($stringIdentifier);

//Use the tested Model's function to create the object
        $this->trophyTypeModel->create($trophyType, true);

//If the object was successfully created, you will be able to find it using the identifier
        $dbTrophyType = $this->trophyTypeModel->findOneBy(['name' => $stringIdentifier]);

//Assert that the identifiers are indeed the same
        $this->assertEquals($stringIdentifier, $dbTrophyType->getName());
    }

    public function testCoreModelDelete() {
//Create a Trophytype object in the db, which can be easily identified
        $stringIdentifier = "deleteTestIdentifier";
        $trophyType = new Trophytype();
        $trophyType->setName($stringIdentifier);
        $this->trophyTypeModel->create($trophyType, true);

//Make sure that it exists in the database, by finding it and asserting its identifier.
//If it does not exist, the assertion will fail.
        $dbTrophyType = $this->trophyTypeModel->findOneBy(['name' => $stringIdentifier]);
        $this->assertEquals($stringIdentifier, $dbTrophyType->getName());

//Use the delete method to delete the record from the db and make sure it really doesn't exist
        $this->trophyTypeModel->delete($dbTrophyType, true);

        try {
            $dbTrophyTypeCheck = $this->trophyTypeModel->findOneBy(['name' => $stringIdentifier]);
            dump($dbTrophyTypeCheck);
        } catch (\Exception $e) {
            $dbTrophyTypeCheck = "Not found";
        }

        $this->assertEquals($dbTrophyTypeCheck, "Not found");
    }

    public function testCoreModelUpdate() {
        //Create a Trophytype object in the db, which can be easily identified
        $stringIdentifier = "updateTestIdentifier";
        $trophyType = new Trophytype();
        $trophyType->setName($stringIdentifier);
        $this->trophyTypeModel->create($trophyType, true);

//Make sure that it exists in the database, by finding it and asserting its identifier.
//If it does not exist, the assertion will fail.
        $dbTrophyType = $this->trophyTypeModel->findOneBy(['name' => $stringIdentifier]);
        $this->assertEquals($stringIdentifier, $dbTrophyType->getName());

        //Update the record by changing the identifier and assert the differences
        $changedIdentifier = 'Changed identifier';
        $dbTrophyType->setName($changedIdentifier);
        $this->trophyTypeModel->update($dbTrophyType, true);

        $dbTrophyTypeChanged = $this->trophyTypeModel->findOneBy(['name' => $changedIdentifier]);
        $this->assertEquals($changedIdentifier, $dbTrophyTypeChanged->getName());
    }

    public function testCoreModelFindOneBy() {

        //Create a Trophytype object in the db, which can be easily identified
        $stringIdentifier = "findOneByTestIdentifier";
        $trophyType = new Trophytype();
        $trophyType->setName($stringIdentifier);
        $this->trophyTypeModel->create($trophyType, true);

//Make sure that it exists in the database, by finding it and asserting its identifier.
//If it does not exist, the assertion will fail.
        $dbTrophyType = $this->trophyTypeModel->findOneBy(['name' => $stringIdentifier]);
        $this->assertEquals($stringIdentifier, $dbTrophyType->getName());

        //Use the same functions with 2 elements in the array
        $dbTrophyType1 = $this->trophyTypeModel->findOneBy(['id' => 6, 'name' => $stringIdentifier]);
        $this->assertEquals($stringIdentifier, $dbTrophyType1->getName());
    }

    public function testCoreModelCheckPropertyByName() {
        //Create a Trophytype object in the db, which can be easily identified
        $stringIdentifier = "checkPropertyByNameTestIdentifier";
        $trophyType = new Trophytype();
        $trophyType->setName($stringIdentifier);
        $this->trophyTypeModel->create($trophyType, true);

        //Assert that the created entity has the specified field
        $this->assertTrue($this->trophyTypeModel->checkPropertyByName('name'));
    }

    public function testCoreModelGetFieldsInfo() {

        //Execute the method and prove that entity's fields exist in the returned array (as keys)
        $info = $this->trophyTypeModel->getFieldsInfo();
        if (array_key_exists('id', $info))
            if (array_key_exists('name', $info))
                $this->assertTrue(true);
            else
                $this->assertTrue(false);
    }

    public function testCoreModelCreateEntities() {

        //Create two Trophytype objects in the db, which can be easily identified, using the createEntities method
        $stringIdentifier = "createEntitiesTestIdentifier";
        $trophyType = new Trophytype();
        $trophyType->setName($stringIdentifier);
        $stringIdentifier1 = $stringIdentifier . "1";
        $trophyType1 = new Trophytype();
        $trophyType1->setName($stringIdentifier1);
        $this->trophyTypeModel->createEntities(new ArrayCollection([$trophyType, $trophyType1]), true);

        //Get two entities specified by the identifiers and assert their names
        $dbTrophyType = $this->trophyTypeModel->findOneBy(['name' => $stringIdentifier]);
        $this->assertEquals($stringIdentifier, $dbTrophyType->getName());
        $dbTrophyType1 = $this->trophyTypeModel->findOneBy(['name' => $stringIdentifier1]);
        $this->assertEquals($stringIdentifier1, $dbTrophyType1->getName());
    }

}
