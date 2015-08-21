<?php


/**
 * Objectinstance, business logic for the service.
 *
 * @author Damian Piela
 * @author Lukasz Sobieraj
 */

namespace TMSolution\GamificationBundle\Model;

use TMSolution\GamificationBundle\Entity\Objectinstance as EntityObjectInstance;

class Objectinstance extends \Core\ModelBundle\Model\Model {
    
    /**
     * Checks if object exists.
     * 
     * @param type $objectIdentity
     * @param type $objectType
     * @return boolean
     */
    public function checkInstance($objectIdentity, $objectType) {
        try {
            return $this->findOneBy(['objectidentity' => $objectIdentity, 'objecttype' => $objectType]);
        } catch (\Exception $ex) {
            return false;
        }
    }

    /**
     * Returns Objectinstance from database, or creates one if doesn't exist, using the createInstance method of Objectinstance.php
     * 
     * @param type $objectIdentity
     * @param type $objectType
     * @return type
     */
    public function getInstance($objectIdentity, $objectType) {
        $objectInstance = $this->checkInstance($objectIdentity, $objectType);
        if (!$objectInstance) {
            $objectInstance = $this->createInstance($objectIdentity, $objectType);
        }
        return $objectInstance;
    }

    
    /**
     * Creates an Objectinstance, using the objectIdentity and objectType provided.
     * 
     * @param type $objectIdentity
     * @param type $objectType
     * @return type
     */
    public function createInstance($objectIdentity, $objectType) {
        $classNameModel = $this->container->get('model_factory')->getModel('TMSolution\GamificationBundle\Entity\Objecttype');
        $classNameObject = $classNameModel->findOneById($objectType);
        $entityObjectInstance = new EntityObjectInstance();
        $entityObjectInstance->setObjecttype($classNameObject);
        $entityObjectInstance->setObjectidentity($objectIdentity);
        return $this->create($entityObjectInstance, true);
    }
}
