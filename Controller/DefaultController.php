<?php

namespace TMSolution\GamificationBundle\Controller;

use Core\BaseBundle\Controller\DefaultController as BaseController;
use Core\BaseBundle\Model\Model;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends BaseController {

    public function checkAction($objectIdentity, $classId) {
        $eventService = $this->get('gamification.events');
        $myEvent = new \TMSolution\GamificationBundle\Entity\Event();

        $register = $eventService->register(1, $objectIdentity, $classId);
        //$model = $this->getModel('TMSolution\GamificationBundle\Entity\Objectinstance');
        //$result = $model->getInstance($objectIdentity, $classId);

        return new JsonResponse($register);
    }

    public function checkTrophyAction($objectInstance, $trophyCategory = null) {
        $eventService = $this->get('gamification.events');
        $result = $eventService->getObjectTrophies($objectInstance, $trophyCategory);
        return new \Symfony\Component\HttpFoundation\Response("sprawdzono istnienie nagrody");
    }

    public function addTrophyAction($objectInstanceId, $trophyId) {

        $objectInstanceModel = $this->getModel('TMSolution\GamificationBundle\Entity\Objectinstance');
        $objectInstance = $objectInstanceModel->findOneBy(['objectidentity'=>$objectInstanceId]);
        $trophyInstanceModel = $this->getModel('TMSolution\GamificationBundle\Entity\Trophy');
        $trophy = $trophyInstanceModel->findOneBy(['id'=>$trophyId]);
        $eventService = $this->get('gamification.events');
        $result = $eventService->addObjectTrophy($objectInstance, $trophy);
        //dump($result);exit();
        return new \Symfony\Component\HttpFoundation\Response("dodano nagrode");
    }

}

//dwie metody, check i create w modelu
//check - musi sprawdzac czy obiekt istnieje w objectinstance, zwrotka true false jesli istnieje
//create - wykorzystuje check do sprawdzenia czy klasa istnieje, jak nie istnieje to eby wytwarzala obiekt nowy