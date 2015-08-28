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

class CoreModel_Test2 extends \PHPUnit_Framework_TestCase {

    /**
     * 
     * createEntities()
     * findOneById()
     * hasOneById
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
     */
    //put your code here
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
        $this->gamerEventModel = $this->modelFactory->getModel('TMSolution\GamificationBundle\Entity\Event');
        $this->eventsService = $this->get('gamification.events');
        $this->gamerEventcategoryModel = $this->modelFactory->getModel('TMSolution\GamificationBundle\Entity\Eventcategory');
        $this->gamertypeModel = $this->modelFactory->getModel('TMSolution\GamificationBundle\Entity\Gamertype');
        $this->ruleModel = $this->modelFactory->getModel('TMSolution\GamificationBundle\Entity\Rule');
        $this->trophyTypeModel = $this->modelFactory->getModel('TMSolution\GamificationBundle\Entity\Trophytype');
        $this->eventCounterModel = $this->modelFactory->getModel('TMSolution\GamificationBundle\Entity\Eventcounter');
        $this->contextModel = $this->modelFactory->getModel('TMSolution\GamificationBundle\Entity\Context');
    }

    public function get($serviceId) {
        return self::$kernel->getContainer()->get($serviceId);
    }

    public function testCoreModelCreateEntities() {
        $rule = new Rule();



        $context = new Context();
        $context->setName('test');
        $context->setRule($rule);

        //$entity = $this->contextModel->createEntities([$context], true);
        //$this->assertNotNull($entity);
    }

    public function testCoreModelFindOneById() {
        $contextObj = new Context();
        $context = $this->contextModel->findOneById(1)->getId();
        $this->assertEquals(1, $context);


        $context = $this->contextModel->findOneById(1);
        //$this->assertSame($contextObj, $context);
    }

    public function testCoreModelHasOneById() {
        $context = $this->contextModel->hasOneById(1);
        $this->assertTrue($context == true);
    }

    public function testCoreModelHasOneBy() {
        $context = $this->contextModel->hasOneBy(['id' => 1]);
        $this->assertTrue($context == true);
    }

    public function testCoreModelFindBy() {
        $contextObj = new Context();
        $context = $this->contextModel->findBy(['id' => 1]);
        $a = $context[0];
        $this->assertNotNull($context);
        $this->assertTrue(is_object($a));
        $this->assertTrue($a instanceof $contextObj);
    }

    public function testCoreModelFindAll() {
        $contextObj = new Context();
        $context = $this->contextModel->findAll();
        dump($context);exit;
        $id = $context[0]->getId();
        $this->assertNotNull($context);
        $this->assertEquals(1, $id);
    }

    public function testCoreModelRead() {

        $context = $this->contextModel->read();
        $this->assertTrue(is_array($context));
    }

    public function testCoreModelHasKey() {

        $array = ['id' => 1, 'name' => 'test'];
        $id = hasKey('id', $array);
        $this->assertNotNull($id); 
    }

    public function testCoreModelGetProperties() {

        $context = $this->contextModel->getProperties();
        $id = $context[0];
        $name = $context[1];
        $this->assertEquals('id', $id);
        $this->assertEquals('name', $name);
    }

    public function testCoreModelCheckMethod() {
        $contextObj = new Context();
        $id = "Id";
        $context = $this->contextModel->checkMethod($contextObj, $id);
        $this->assertEquals("getId", $context);
    }

    //nie testowac
//    public function testCoreModelGetEntityName(){
//        
//        $context =  $this->contextModel->getEntityName();
//        dump($context);exit;
//    }

    public function testCoreModelCheckMethodPrefix() {

        //$methodName = $this->contextModel->checkMethodPrefix('name');
        //dump($methodName);exit;
    }

    public function testCoreModelChecktMethodExists() {

        $context = $this->contextModel->checktMethodExists("getId");
        $this->assertEquals("getId", $context);
    }
    
 

}
