<?php

namespace TMSolution\GamificationBundle\Controller;

use Core\BaseBundle\Controller\DefaultController as BaseController;
use Core\BaseBundle\Model\Model;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Config\Definition\Exception\Exception;
use Hoa\Ruler\Ruler;
use Hoa\Ruler\Context;
use TMSolution\GamificationBundle\Entity\Objecttrophy;
use TMSolution\GamificationBundle\Service\EventService;

class DefaultController extends /*\Symfony\Component\DependencyInjection\ContainerAware*/BaseController {

    public function checkAction($objectIdentity, $classId) {
        $eventService = $this->get('gamification.events');
        $myEvent = new \TMSolution\GamificationBundle\Entity\Event();

        $register = $eventService->register(1, $objectIdentity, $classId);
        //$model = $this->getModel('TMSolution\GamificationBundle\Entity\Objectinstance');
        //$result = $model->getInstance($objectIdentity, $classId);

        return new JsonResponse($register);
    }

    public function checkTrophyAction($objectInstance, $trophyCategory = null) {
        echo "przed sleepem";
        return new Response("lslsl");
//        sleep(5);
//        echo" po sleepie jestem akcja check trophy ";
//        $eventService = $this->get('gamification.events');
//        $result = $eventService->getObjectTrophies($objectInstance, $trophyCategory);
//        return new \Symfony\Component\HttpFoundation\Response("sprawdzono istnienie nagrody");
    }

    public function addTrophyAction($objectInstanceId, $trophyId) {
//  do testu listenerexception
//       try{
//           throw new Exception();
//       } catch (Exception $ex) {
//           throw $ex;
//       }

        $objectInstanceModel = $this->getModel('TMSolution\GamificationBundle\Entity\Objectinstance');
        $objectInstance = $objectInstanceModel->findOneBy(['objectidentity' => $objectInstanceId]);
        $trophyInstanceModel = $this->getModel('TMSolution\GamificationBundle\Entity\Trophy');
        $trophy = $trophyInstanceModel->findOneBy(['id' => $trophyId]);
        $eventService = $this->get('gamification.events');
        $result = $eventService->addObjectTrophy($objectInstance, $trophy);
        //dump($result);exit();


        return new \Symfony\Component\HttpFoundation\Response("dodano nagrode");
    }

    //@ToDo: do przeanalizowania i napisania
    //
    public function checkRuleAction($objectId) {
        $objectTrophyModel = $this->getModel('TMSolution\GamificationBundle\Entity\Objecttrophy');
        $array = ['objectid' => $objectId];
        $objectTrophyInstance = $objectTrophyModel->findBy($array);
        $count = count($objectTrophyInstance);
        //dump($count);exit;

        $ruleModel = $this->getModel('TMSolution\GamificationBundle\Entity\Rule');
        $ruleRecord = $ruleModel->findBy(['id' => 1]);
        $rule = $ruleRecord[0]->getName();

        $ruler = new Ruler();
        $context = new Context();
        $context['points'] = $count;

        $result = $ruler->assert($rule, $context);

        if ($result) {
            $objectInstanceModel = $this->getModel('TMSolution\GamificationBundle\Entity\Objectinstance');
            $objectInstanceArray = $objectInstanceModel->findBy(['id' => $objectId]);
            $objectInstance = $objectInstanceArray[0];
            //dump($objectInstance);exit;

            $newObjectTrophy = new Objecttrophy();
            $newObjectTrophy->setDate(new \DateTime('NOW'));
            $newObjectTrophy->setObjectid($objectInstance);

            $trophyModel = $this->getModel('TMSolution\GamificationBundle\Entity\Trophy');
            $trophyArray = $trophyModel->findBy(['id' => 2]);
            $trophy = $trophyArray[0];
            $newObjectTrophy->setTrophyid($trophy);

            $objectTrophyModel->create($newObjectTrophy, true);

            return new Response("operation complete");
        }
    }

    public function testSoapAction() {


      
        
        $objSoapClient = new \SoapClient("http://localhost/rulestest/rulestest/web/app_dev.php/ws/GamificationAPI?wsdl");
        // dump($objSoapClient);
//        //;
        try {
            $result = $objSoapClient->test(1);
               $result2 = $objSoapClient->hello(1);
            
            
        } catch (\Exception $ex) {
            
         
         die("hello");
        }
        echo $result;
        echo $result2;
       die("Do widzenia");
        
        
    }

}

//dwie metody, check i create w modelu
//check - musi sprawdzac czy obiekt istnieje w objectinstance, zwrotka true false jesli istnieje
//create - wykorzystuje check do sprawdzenia czy klasa istnieje, jak nie istnieje to eby wytwarzala obiekt nowy