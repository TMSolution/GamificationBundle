<?php

namespace TMSolution\GamificationBundle\Controller;

use BeSimple\SoapBundle\ServiceDefinition\Annotation as Soap;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DependencyInjection\ContainerAware;
use TMSolution\GamificationBundle\Service\EventService;
use Core\BaseBundle\Controller\DefaultController as BaseController;

class APIController extends BaseController {

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

        return "dupa i cycki";
    }

    //get object trophies

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

        $objectInstanceModel = $this->getModel('TMSolution\GamificationBundle\Entity\Objectinstance');
        $objectInstance = $objectInstanceModel->getInstance($objectIdentity, $objectTypeId);
        $eventService = $this->get('gamification.events');

        $result = $eventService->getObjectTrophies($objectInstance);
        dump($result);exit;

        return new Response($result);
    }

}
