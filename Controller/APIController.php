<?php

/**
 * APIController
 * 
 * @author Damian Piela
 * @author Lukasz Sobieraj
 */

namespace TMSolution\GamificationBundle\Controller;

use BeSimple\SoapBundle\ServiceDefinition\Annotation as Soap;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DependencyInjection\ContainerAware;
use TMSolution\GamificationBundle\Service\EventService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class APIController extends Controller {
    

    /**
     * @Soap\Method("test")
     * @Soap\Param("paramId", phpType = "int")
     * @Soap\Result(phpType = "string")
     */
    public function testAction($paramId) {
       
        return "dfdfd";
    }

    /**
     * @Soap\Method("hello")
     * @Soap\Param("paramId", phpType = "int")
     * @Soap\Result(phpType = "string")
     */
    public function helloAction($paramId) {
        
        return "jabłko i gruszka";
        
    }

    
   

//    /**
//     * 
//     * @Soap\Method("checkGamerTrophy")
//     * @Soap\Param("gamerTypeId", phpType = "int")
//     * @Soap\Param("gamerIdentity", phpType = "int")
//     * @Soap\Result(phpType= "array")
//     */
//    public function checkGamerTrophyAction($gamerTypeId, $gamerIdentity) {
//       
//        $gamerInstanceMo = $this->get('model_factory');
//        $gamerInstanceModel = $gamerInstanceMo->getModel('TMSolution\GamificationBundle\Entity\Gamerinstance');
//        $gamerInstance = $gamerInstanceModel->getInstance($gamerIdentity, $gamerTypeId);
//        $eventService = $this->get('gamification.events');
//        $result = $eventService->getGamerTrophies($gamerInstance);
//        return new Response($result);
//    }

    
     /*
     * * A SOAP method that returns an array of objects, type Gamertrophy, that - 
     * if exist - represent the user's collected trophies. Otherwise, the null
     *  is returned.
     */
    
    /*
     * @Soap\Method("checkGamerTrophy")
     * @Soap\Param("gamerTypeId", phpType = "int")
     * @Soap\Param("gamerIdentity", phpType = "int")
     * @Soap\Result(phpType= "array")
     */
    
}
