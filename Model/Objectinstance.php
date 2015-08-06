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

class Objectinstance extends \Core\ModelBundle\Model\Model {

    
    
    // check if the instance exists
    public function checkInstance($objectIdentity, $objectType) {


        try {
            return $this->findOneBy(['objectidentity' => $objectIdentity, 'objecttype' => $objectType]);
        } catch (\Exception $ex) {
            return false;
        }
    }

    // get the instance
    public function getInstance($objectIdentity, $objectType) {
        $objectInstance = $this->checkInstance($objectIdentity, $objectType);
        if (!$objectInstance) {
            //create object
            $objectInstance = $this->createInstance($objectIdentity, $objectType);
        }
        return $objectInstance;
    }

    
    //create new instance object if it doesn't exist
    public function createInstance($objectIdentity, $objectType) {
        //wytworzenie encji TMSolution\GamificationBundle\Model
        $classNameModel = $this->container->get('model_factory')->getModel('TMSolution\GamificationBundle\Entity\Objecttype');
        $classNameObject = $classNameModel->findOneById($objectType);
        $entityObjectInstance = new EntityObjectInstance();
        $entityObjectInstance->setObjecttype($classNameObject);
        $entityObjectInstance->setObjectidentity($objectIdentity);
        return $this->create($entityObjectInstance, true);
    }

}
