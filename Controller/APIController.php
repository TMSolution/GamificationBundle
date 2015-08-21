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


    /**
     * A SOAP method that returns an array of objects, type Objecttrophy, that - 
     * if exist - represent the user's collected trophies. Otherwise, the null
     *  is returned.
     * 
     * @Soap\Method("checkObjectTrophy")
     * @Soap\Param("objectTypeId", phpType = "int")
     * @Soap\Param("objectIdentity", phpType = "int")
     * @Soap\Result(phpType= "array")
     * 
     */
    public function checkObjectTrophyAction($objectTypeId, $objectIdentity) {

        $objectInstanceMo = $this->get('model_factory');
        $objectInstanceModel = $objectInstanceMo->getModel('TMSolution\GamificationBundle\Entity\Objectinstance');
        $objectInstance = $objectInstanceModel->getInstance($objectIdentity, $objectTypeId);
        $eventService = $this->get('gamification.events');
        $result = $eventService->getObjectTrophies($objectInstance);
        return new Response($result);
    }

}
