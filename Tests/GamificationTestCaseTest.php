<?php

/**
 * Description of GamificationTestCase1
 *
 * @author Damian Piela <damian.piela@tmsolution.pl>
 */

namespace TMSolution\GamificationBundle\Tests;

class GamificationTestCaseTest extends \PHPUnit_Framework_TestCase {

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
    protected $eventModel;

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
        $this->eventModel = $this->modelFactory->getModel('TMSolution\GamificationBundle\Entity\GamificationEvent');
        $this->eventsService = $this->get('gamification.events');
        $this->gamerGamificationEventcategoryModel = $this->modelFactory->getModel('TMSolution\GamificationBundle\Entity\GamificationEventcategory');
        $this->gamertypeModel = $this->modelFactory->getModel('TMSolution\GamificationBundle\Entity\Gamertype');
        $this->ruleModel = $this->modelFactory->getModel('TMSolution\GamificationBundle\Entity\Rule');
    }

    public function get($serviceId) {
        return self::$kernel->getContainer()->get($serviceId);
    }

    public function testGamificationTestCase() {
        // 1.       Take an appropriate user from the database. If he doesn’t exist, he is created.
        $gamerInstanceId = 1;
        $gamerInstance = $this->gamerinstanceModel->findOneById($gamerInstanceId);

        // 2.       Determine which GamificationEvent was evoked.
        $eventInstanceId = 1;
        $eventInstance = $this->eventModel->findOneById($eventInstanceId);

        // 3.       Use the register() method, which registers an event for the appropriate user.
        $this->eventsService->register($eventInstance->getGamificationEventcategoryid(), $gamerInstance->getGameridentity(), $gamerInstance->getGamertype());

        // 4.       Using the checkRule() method, check if the rule is true.
        $trophy = $this->trophyModel->findOneById(2);
        $this->eventsService->checkRule($gamerInstance, $trophy); // domyślnie nie będzie przyznana, bo jest to nagroda jednorazowa i ustawiana jest w loaderach
        
        // 5.       Using the addGamertrophy()  award – or not – the appropriate trophy. 
        // checkRule automatycznie przyznaje nagrodę
    }

}
