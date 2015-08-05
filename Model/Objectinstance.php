<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Objectinstance
 *
 * @author Lukasz
 */

namespace TMSolution\GamificationBundle\Model;

use TMSolution\GamificationBundle\Entity\Objectinstance as EntityObjectInstance;

class Objectinstance extends \Core\BaseBundle\Model\Model {

    
    
    // check if the instance exists
    public function checkInstance($objectIdentity, $objectTypeId) {


        try {
            return $this->findOneBy(['objectidentity' => $objectIdentity, 'objecttypeid' => $objectTypeId]);
        } catch (\Exception $ex) {
            return false;
        }
    }

    // get the instance
    public function getInstance($objectIdentity, $objectTypeId) {
        $objectInstance = $this->checkInstance($objectIdentity, $objectTypeId);
        if (!$objectInstance) {
            //create object
            $objectInstance = $this->createInstance($objectIdentity, $objectTypeId);
        }
        return $objectInstance;
    }

    
    //create new instance object if it doesn't exist
    public function createInstance($objectIdentity, $objectTypeId) {
        //wytworzenie encji TMSolution\GamificationBundle\Model
        $classNameModel = $this->container->get('model_factory')->getModel('TMSolution\GamificationBundle\Entity\Objecttype');
        $classNameObject = $classNameModel->findOneById($objectTypeId);
        $entityObjectInstance = new EntityObjectInstance();
        $entityObjectInstance->setObjecttypeid($classNameObject);
        $entityObjectInstance->setObjectidentity($objectIdentity);
        return $this->create($entityObjectInstance, true);
    }

}
