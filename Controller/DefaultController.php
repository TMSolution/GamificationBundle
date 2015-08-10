<?php

namespace TMSolution\GamificationBundle\Controller;

use Core\ModelBundle\Model\Model;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Config\Definition\Exception\Exception;
use Hoa\Ruler\Ruler;
use Hoa\Ruler\Context;
use TMSolution\GamificationBundle\Entity\Objecttrophy;
use TMSolution\GamificationBundle\Service\EventService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

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
        $objectInstanceMo = $this->get('model_factory');
        $objectInstanceModel = $objectInstanceMo->getModel('TMSolution\GamificationBundle\Entity\Objectinstance');
        $objectInstance = $objectInstanceModel->findOneBy(['objectidentity' => $objectInstanceId]);
        
        $trophyInstanceMo = $this->get('model_factory');
        $trophyInstanceModel = $trophyInstanceMo->getModel('TMSolution\GamificationBundle\Entity\Trophy');
        $trophy = $trophyInstanceModel->findOneBy(['id' => $trophyId]);
        $eventService = $this->get('gamification.events');
        $result = $eventService->addObjectTrophy($objectInstance, $trophy);
        //dump($result);exit();


        return new \Symfony\Component\HttpFoundation\Response("dodano nagrode");
    }

    //@ToDo: do przeanalizowania i napisania
    //
    public function checkRuleAction($objectId) {
        $model = $this->get('model_factory');
        $objectTrophyModel = $model->getModel('TMSolution\GamificationBundle\Entity\Objecttrophy');
        $array = ['object' => $objectId];
        $objectTrophyInstance = $objectTrophyModel->findBy($array);
        $count = count($objectTrophyInstance);
        
        //dump($count);exit;
        $ruleMo = $this->get('model_factory');
        $ruleModel = $ruleMo->getModel('TMSolution\GamificationBundle\Entity\Rule');
        $ruleRecord = $ruleModel->findBy(['id' => 1]);
        $ruleObject = $ruleRecord[0];
        
        //$rule = $ruleRecord[0]->getName();
        $rule = $ruleObject->getContext() . ' ' . $ruleObject->getOperator() . ' ' . $ruleObject->getValue();
        
        
        $ruler = new Ruler();
        $context = new Context();
        $context['points'] = $count;
        $result = $ruler->assert($rule, $context);
        
        //dump($result);exit;
        if ($result) {
            $objectInstanceMo = $this->get('model_factory');        
            $objectInstanceModel = $objectInstanceMo->getModel('TMSolution\GamificationBundle\Entity\Objectinstance');
            $objectInstanceArray = $objectInstanceModel->findBy(['id' => $objectId]);
            $objectInstance = $objectInstanceArray[0];
            
            $newObjectTrophy = new Objecttrophy();
            $newObjectTrophy->setDate(new \DateTime('NOW'));
            $newObjectTrophy->setObject($objectInstance);
            

            $trophyMo = $this->get('model_factory');
            $trophyModel = $trophyMo->getModel('TMSolution\GamificationBundle\Entity\Trophy');
   
            $trophyArray = $trophyModel->findBy(['id' => 2]);
            $trophy = $trophyArray[0];
            $newObjectTrophy->setTrophy($trophy);

            $objectTrophyModel->create($newObjectTrophy, true);
                     
            return new Response("operation complete");
        }else{
            return new Response("operation failed");
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
    
    public function ruletestAction($objectInstanceId, $trophyId, $ruleId){
        
        $service = $this->get('gamification.events');
        $res = $service->checkRule($objectInstanceId, $trophyId, $ruleId);
        
        
        
        return new Response(/*$res->getContent()*/dump($res));
    }

}

//dwie metody, check i create w modelu
//check - musi sprawdzac czy obiekt istnieje w objectinstance, zwrotka true false jesli istnieje
//create - wykorzystuje check do sprawdzenia czy klasa istnieje, jak nie istnieje to eby wytwarzala obiekt nowy