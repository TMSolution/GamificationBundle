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

class DefaultController extends Controller
{

    // WARNING! The way the result is returned is for presentation purposes only and most probably will have to be updated.
    //Checks if event already exists. If not, registers it in the db.
    public function checkAction($eventCategoryId, $objectIdentity, $classId)
    {
        $eventService = $this->get('gamification.events');
//        $myEvent = new \TMSolution\GamificationBundle\Entity\Event();
//            $eventObject = $model->getModel('TMSolution\GamificationBundle\Entity\Event')->findOneBy(['objectidentity' => $objectInstanceId]);

        
        
        $registeredObject = $eventService->register($eventCategoryId, $objectIdentity, $classId);
        return new JsonResponse($registeredObject);
    }

    // WARNING! The way the result is returned is for presentation purposes only and most probably will have to be updated.
    /* This function returns a list of a certain user's trophies.
     * By default, all kinds of trophies are returned, but the second 
     * argument may specify the kind of trophy.
     * 
     * @param integer $objectInstanceId
     * @param integer $trophyCategoryId
     * @return Response
     */
    public function checkTrophyAction($objectInstanceId, $trophyCategoryId = null)
    {
        $objectInstance = $this->get('model_factory')->getModel('TMSolution\GamificationBundle\Entity\Objectinstance')
                ->findOneBy(['objectidentity' => $objectInstanceId]);
        $trophyCategory = null;
        if ($trophyCategoryId == null) {
            $trophyCategory = $this->get('model_factory')->getModel('TMSolution\GamificationBundle\Entity\Trophycategory')
                    ->findOneBy(['id' => $objectInstanceId]);
        }
        $result = $this->get('gamification.events')->getObjectTrophies($objectInstance, $trophyCategory);
        return new Response(dump($result));
    }

    // WARNING! The way the result is returned is for presentation purposes only and most probably will have to be updated.
    /*
     * Adds a trophy object to the specified user. Presents the object as a result.
     * In case neither the user nor trophy exists, returns appropriate information.
     */
    public function addTrophyAction($objectInstanceId, $trophyId)
    {
        $response = null;
        try {
            $model = $this->get('model_factory');
            $objectInstance = $model->getModel('TMSolution\GamificationBundle\Entity\Objectinstance')->findOneBy(['objectidentity' => $objectInstanceId]);
            $trophyObject = $model->getModel('TMSolution\GamificationBundle\Entity\Trophy')->findOneBy(['id' => $trophyId]);
        } catch (\Exception $e) {
            $response = new Response('Podane dane nie istnieją'); //Exception return option
        }
        $addedTrophy = $this->get('gamification.events')->addObjectTrophy($objectInstance, $trophyObject);
        return new Response(dump($addedTrophy)); //Primary return
    }

    //obsolete - appropriate service provided
    //@ToDo: do przeanalizowania i napisania
    public function checkRuleAction($objectId)
    {
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
        } else {
            return new Response("operation failed");
        }
    }

    //obsolete
    public function testSoapAction()
    {

        $objSoapClient = new \SoapClient("http://localhost/rulestest/rulestest/web/app_dev.php/ws/GamificationAPI?wsdl");
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

    // WARNING! The way the result is returned is for presentation purposes only and most probably will have to be updated.
    public function ruletestAction($objectInstanceId, $trophyId, $ruleId)
    {
        $model = $this->container->get('model_factory');
        $objectInstance = $model->getModel('TMSolution\GamificationBundle\Entity\Objectinstance')->findOneBy(['objectidentity' => $objectInstanceId]);
        $trophyObject = $model->getModel('TMSolution\GamificationBundle\Entity\Trophy')->findOneById($trophyId);
        //dump($trophyObject); exit;
        $service = $this->get('gamification.events');
        $res = $service->checkRule($objectInstance, $trophyObject);

        return new Response(dump($res));
    }

}

//dwie metody, check i create w modelu
//check - musi sprawdzac czy obiekt istnieje w objectinstance, zwrotka true false jesli istnieje
//create - wykorzystuje check do sprawdzenia czy klasa istnieje, jak nie istnieje to eby wytwarzala obiekt nowy