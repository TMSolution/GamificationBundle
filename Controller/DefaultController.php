<?php

/**
 * DefaultController
 * 
 * @author Damian Piela
 * @author Lukasz Sobieraj
 */

namespace TMSolution\GamificationBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    // WARNING! The way the result is returned is for presentation purposes only and most probably will have to be updated.
    // Checks if event already exists. If not, registers it in the db.
    public function checkAction($eventCategoryId, $objectIdentity, $classId) {
        $eventService = $this->get('gamification.events');
        $registeredObject = $eventService->register($eventCategoryId, $objectIdentity, $classId);
        return new JsonResponse($registeredObject);
    }

    // WARNING! The way the result is returned is for presentation purposes only and most probably will have to be updated.
    /** This function returns a list of a certain user's trophies.
     * By default, all kinds of trophies are returned, but the second 
     * argument may specify the kind of trophy.
     * 
     * @param integer $objectInstanceId
     * @param integer $trophyCategoryId
     * @return Response
     */
    public function checkTrophyAction($objectInstanceId, $trophyCategoryId = null) {
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
    /**
     * Adds a trophy object to the specified user. Presents the object as a result.
     * In case neither the user nor trophy exists, returns appropriate information.
     * 
     * @param integer $objectInstanceId 
     * @param integer $trophyId
     */
    public function addTrophyAction($objectInstanceId, $trophyId) {
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

    //obsolete - test method
    public function testSoapAction() {

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
    public function ruletestAction($objectInstanceId, $trophyId, $ruleId) {
        $model = $this->container->get('model_factory');
        $objectInstance = $model->getModel('TMSolution\GamificationBundle\Entity\Objectinstance')->findOneBy(['objectidentity' => $objectInstanceId]);
        $trophyObject = $model->getModel('TMSolution\GamificationBundle\Entity\Trophy')->findOneById($trophyId);
        $service = $this->get('gamification.events');
        $res = $service->checkRule($objectInstance, $trophyObject);

        return new Response(dump($res));
    }

}
