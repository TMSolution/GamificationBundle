<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CoreModel_Test2
 *
 * @author Lukasz Sobieraj
 */

namespace TMSolution\GamificationBundle\Tests;

use TMSolution\GamificationBundle\Entity\Context;
use TMSolution\GamificationBundle\Entity\Rule;
//do testow wsdl - metody wykorzystywane przez wsdl
use TMSolution\GamificationBundle\Controller\APIController;

class CoreModelTest_2 extends \PHPUnit_Framework_TestCase {

    /**
     * 
     * findOneById()
     * hasOneById() - nie testowac
     * hasOneBy()
     * findBy()
     * findAll()
     * read()
     * hasKey()
     * getProperties()
     * checkMethod()
     * getEntityName() - nie testowac
     * checkMethodPrefix() - do poprawy metoda
     * checktMethodExists()
     * methods WSDL
     */
    protected static $kernel;
    protected static $container;
    protected $gamerinstanceModel;
    protected $trophyModel;
    protected $gamerTrophyModel;
    protected $eventsService;
    protected $modelFactory;
    protected $gamificationModel;
    protected $gamerGamificationEventcategoryModel;
    protected $gamertypeModel;
    protected $ruleModel;
    protected $trophyTypeModel;
    protected $eventCounterModel;
    protected $name;
    protected $age;
    protected $contextModel;

    public static function setUpBeforeClass() {

        self::$kernel = new \AppKernel('test', true);
        self::$kernel->boot();
        self::$container = self::$kernel->getContainer()

        ;
    }

    public function setUp() {

        $this->modelFactory = $this->get('model_factory');
        $this->gamerinstanceModel = $this->modelFactory->getModel('TMSolution\GamificationBundle\Entity\Gamerinstance');
        $this->trophyModel = $this->modelFactory->getModel('TMSolution\GamificationBundle\Entity\Trophy');
        $this->gamerTrophyModel = $this->modelFactory->getModel('TMSolution\GamificationBundle\Entity\Gamertrophy');
        $this->gamerGamificationEventModel = $this->modelFactory->getModel('TMSolution\GamificationBundle\Entity\GamificationEvent');
        $this->eventsService = $this->get('gamification.events');
        $this->gamerGamificationEventcategoryModel = $this->modelFactory->getModel('TMSolution\GamificationBundle\Entity\GamificationEventcategory');
        $this->gamertypeModel = $this->modelFactory->getModel('TMSolution\GamificationBundle\Entity\Gamertype');
        $this->ruleModel = $this->modelFactory->getModel('TMSolution\GamificationBundle\Entity\Rule');
        $this->trophyTypeModel = $this->modelFactory->getModel('TMSolution\GamificationBundle\Entity\TrophyType');
        $this->eventCounterModel = $this->modelFactory->getModel('TMSolution\GamificationBundle\Entity\GamificationEventcounter');
        $this->contextModel = $this->modelFactory->getModel('TMSolution\GamificationBundle\Entity\Context');
    }

    public function get($serviceId) {
        return self::$kernel->getContainer()->get($serviceId);
    }

    public function testCoreModelFindOneById() {

        $contextObj = new Context();
        $contextFull = $this->contextModel->findOneById(1);
        $this->assertTrue($contextFull instanceof $contextObj);


        $contextId = $this->contextModel->findOneById(1)->getId();
        $this->assertEquals(1, $contextId);

        $this->setExpectedException('\Doctrine\ORM\EntityNotFoundException');
        $contextFalse = $this->contextModel->findOneById(4);
    }

    //metoda hasOneById() w swoim dzialaniu wykorzystuje metode getReference(), ktora przyjmujac argument sprawdza jego istnienie, gdy nie ma to go tworzy.
    //powoduje to nie wykonanie negatywnego testu, gdyz wpisanie nieistniejacego id powoduje jego wytworzenie przez co test zawsze zwraca true
//    public function testCoreModelHasOneById() {
//        $context = $this->contextModel->hasOneById(9);
//        //dump($context);exit;
//        //$this->assertTrue($context);
//    
//    }

    public function testCoreModelHasOneBy() {

        $context = $this->contextModel->hasOneBy(['id' => 1]);
        $this->assertTrue($context);

        $contextFalse = $this->contextModel->hasOneBy(['id' => 3]);
        $this->assertFalse($contextFalse);
    }

    public function testCoreModelFindBy() {

        $contextObj = new Context();
        $context = $this->contextModel->findBy(['id' => 1]);
        $this->assertTrue(is_array($context));

        $object = $context[0];

        $this->assertTrue(is_object($object));
        $this->assertTrue($object instanceof $contextObj);
    }

    public function testCoreModelFindAll() {

        $contextObj = new Context();
        $context = $this->contextModel->findAll();
        $id = $context[0]->getId();
        $this->assertNotNull($context);
        $this->assertEquals(1, $id);

        $contextFalse = $context[3];
        $this->assertNull($contextFalse);
    }

    //metoda read( wymaga parametru typu array, jednak dziala bez) - do poprawy
    public function testCoreModelRead() {

        $context = $this->contextModel->read();
        $this->assertTrue(is_array($context));

        $contextFalse = $this->contextModel->read();

    }

    public function testCoreModelHasKey() {

        $contextObj = $this->contextModel->findBy(['id' => 1]);
        $context = $this->contextModel->hasKey(0, $contextObj);
        $this->assertTrue(is_object($context));

        $contextFalse = $this->contextModel->hasKey(1, $contextObj);
        $this->assertFalse($contextFalse);
    }

    public function testCoreModelGetProperties() {

        $context = $this->contextModel->getProperties();
        $id = $context[0];
        $name = $context[1];
        $this->assertEquals('id', $id);
        $this->assertEquals('name', $name);

        $testFalse - $context[3];
        $this->assertNull($testFalse);
    }

    public function testCoreModelCheckMethod() {

        $contextObj = new Context();
        $id = "Id";
        $context = $this->contextModel->checkMethod($contextObj, $id);
        $contextMethod = $this->contextModel->findOneById(1)->$context();

        $this->assertEquals("getId", $context);
        $this->assertEquals(1, $contextMethod);

        $falseMethod = "Rule";
        $contextFalse = $this->contextModel->checkMethod($contextObj, $falseMethod);
        $this->assertNotEquals("getRule", $contextFalse);
    }

    //nie testowac
//    public function testCoreModelGetEntityName(){
//        
//        $context =  $this->contextModel->getEntityName();
//        dump($context);exit;
//    }
    //metoda do poprawy - nie testowac
//    public function testCoreModelCheckMethodPrefix() {
//
//        //$methodName = $this->contextModel->checkMethodPrefix('name');
//        //dump($methodName);exit;
//    }

    public function testCoreModelChecktMethodExists() {

        $context = $this->contextModel->checktMethodExists("getId");
        $this->assertEquals("getId", $context);

        $contextFalse = $this->contextModel->checktMethodExists("getRule");
        $this->assertFalse($contextFalse);
    }

    //test wsdl
    public function testWSDL_Method() {

        $test = new APIController();
        $result = $test->testAction(1);
        $this->assertEquals(testAction, $result);

        $result2 = $test->helloAction(1);
        $this->assertEquals("jabłko i gruszka", $result2);
    }

}
