<?php

namespace TMSolution\GamificationBundle\Controller;

use Core\BaseBundle\Controller\DefaultController as BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;
use BeSimple\SoapBundle\ServiceDefinition\Annotation as Soap;
use Core\SecurityBundle\Annotations\Permissions;
use Symfony\Component\Security\Acl\Permission\MaskBuilder;
use TMSolution\GamificationBundle\Service\EventService;

class APIController extends BaseController {

    /**
     * @Soap\Method("test")
     * @Soap\Param("paramId", phpType = "int")
     * @Soap\Result(phpType = "string")
     * @Permissions(rights={MaskBuilder::MASK_MASTER})
     */
    public function testAction($paramId) {

        return "test";
    }

    //method for checking who is who
    public function checkobjectAction($id) {

        $objectloginModel = $this->getModel('TMSolution\GamificationBundle\Entity\Objecttrophy');
        $result = $objectloginModel->findBy(['id' => $id]);
        $objectInstance = $result[0]->getObjectid()->getId();
        $eventService = $this->get('gamification.events');
        $res = $eventService->getObjectTrophies($objectInstance);
        dump($res);
        exit;
        return $res;
    }

    //the same like getobjectTrophies
    //argument: objectIdentity
    public function infowsdlAction($objectIdentity) {

        //jakis staly parametr
        $trophyCategory = 1;

        $objectTrophyModel = $this->container->get('model_factory')
                ->getModel('TMSolution\GamificationBundle\Entity\Objecttrophy');
        if ($trophyCategory != null) {
            $result = $objectTrophyModel->findBy(['objectid' => $objectIdentity, 'trophyid' => $trophyCategory]);
        }

        return $result;
    }

}
