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
    public function checkInstance($objectIdentity, $classId) {


        try {
            return $this->findOneBy(['objectidentity' => $objectIdentity, 'classid' => $classId]);
        } catch (\Exception $ex) {
            return false;
        }
    }

    // get the instance
    public function getInstance($objectIdentity, $classId) {
        $objectInstance = $this->checkInstance($objectIdentity, $classId);
        if (!$objectInstance) {
            //create object
            $objectInstance = $this->createInstance($objectIdentity, $classId);
        }
        return $objectInstance;
    }

    
    //create new instance object if it doesn't exist
    public function createInstance($objectIdentity, $classId) {
        //wytworzenie encji TMSolution\GamificationBundle\Model
        $classNameModel = $this->container->get('model_factory')->getModel('TMSolution\GamificationBundle\Entity\Classname');
        $classNameObject = $classNameModel->findOneById($classId);
        $entityObjectInstance = new EntityObjectInstance();
        $entityObjectInstance->setClassid($classNameObject);
        $entityObjectInstance->setObjectidentity($objectIdentity);
        return $this->create($entityObjectInstance, true);
    }

}
