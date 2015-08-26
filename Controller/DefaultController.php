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
    public function checkAction($eventCategoryId, $gamerIdentity, $classId) {
        $eventService = $this->get('gamification.events');
        $registeredGamer = $eventService->register($eventCategoryId, $gamerIdentity, $classId);
        return new JsonResponse($registeredGamer);
    }

    // WARNING! The way the result is returned is for presentation purposes only and most probably will have to be updated.
    /** This function returns a list of a certain user's trophies.
     * By default, all kinds of trophies are returned, but the second 
     * argument may specify the kind of trophy.
     * 
     * @param integer $gamerInstanceId
     * @param integer $trophyCategoryId
     * @return Response
     */
    public function checkTrophyAction($gamerInstanceId, $trophyCategoryId = null) {
        $gamerInstance = $this->get('model_factory')->getModel('TMSolution\GamificationBundle\Entity\Gamerinstance')
                ->findOneBy(['gameridentity' => $gamerInstanceId]);
        $trophyCategory = null;
        if ($trophyCategoryId == null) {
            $trophyCategory = $this->get('model_factory')->getModel('TMSolution\GamificationBundle\Entity\Trophycategory')
                    ->findOneBy(['id' => $gamerInstanceId]);
        }
        $result = $this->get('gamification.events')->getGamerTrophies($gamerInstance, $trophyCategory);
        return new Response(dump($result));
    }

    // WARNING! The way the result is returned is for presentation purposes only and most probably will have to be updated.
    /**
     * Adds a trophy gamer to the specified user. Presents the gamer as a result.
     * In case neither the user nor trophy exists, returns appropriate information.
     * 
     * @param integer $gamerInstanceId 
     * @param integer $trophyId
     */
    public function addTrophyAction($gamerInstanceId, $trophyId) {
        $response = null;
        try {
            $model = $this->get('model_factory');
            $gamerInstance = $model->getModel('TMSolution\GamificationBundle\Entity\Gamerinstance')->findOneBy(['gameridentity' => $gamerInstanceId]);
            $trophyGamer = $model->getModel('TMSolution\GamificationBundle\Entity\Trophy')->findOneBy(['id' => $trophyId]);
        } catch (\Exception $e) {
            $response = new Response('Podane dane nie istnieją'); //Exception return option
        }
        $addedTrophy = $this->get('gamification.events')->addGamerTrophy($gamerInstance, $trophyGamer);
        return new Response(dump($addedTrophy)); //Primary return
    }

    //obsolete - test method
    public function testSoapAction() {
        ini_set("soap.wsdl_cache_enabled", "0");
        $objSoapClient = new \SoapClient("http://127.0.0.1/rulestest/rulestest/web/app_dev.php/ws/GamificationAPI?wsdl", [
            'trace' => true,
            'cache_wsdl' => WSDL_CACHE_NONE,
            'soap_version' => SOAP_1_1,
            'exceptions' => true,
            'user_agent' => 'PHPSoapClient'
        ]);

        $objSoapClient = new \SoapClient("http://localhost/rulestest/rulestest/web/app_dev.php/ws/GamificationAPI?wsdl");
        try {
            $result = $objSoapClient->test(1);
        } catch (\Exception $ex) {
            die("exception");
        }
        return new Response($result);
    }

    // WARNING! The way the result is returned is for presentation purposes only and most probably will have to be updated.
    public function ruletestAction($gamerInstanceId, $trophyId, $ruleId) {
        $model = $this->container->get('model_factory');
        $gamerInstance = $model->getModel('TMSolution\GamificationBundle\Entity\Gamerinstance')->findOneBy(['gameridentity' => $gamerInstanceId]);
        $trophyGamer = $model->getModel('TMSolution\GamificationBundle\Entity\Trophy')->findOneById($trophyId);
        $service = $this->get('gamification.events');
        $res = $service->checkRule($gamerInstance, $trophyGamer);

        return new Response(dump($res));
    }

}
