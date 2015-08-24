<?php


/**
 * Gamerinstance, business logic for the service.
 *
 * @author Damian Piela
 * @author Lukasz Sobieraj
 */

namespace TMSolution\GamificationBundle\Model;

use TMSolution\GamificationBundle\Entity\Gamerinstance as EntityObjectInstance;

class Gamerinstance extends \Core\ModelBundle\Model\Model {
    
    /**
     * Checks if object exists.
     * 
     * @param type $gamerIdentity
     * @param type $gamerType
     * @return boolean
     */
    public function checkInstance($gamerIdentity, $gamerType) {
        try {
            return $this->findOneBy(['gameridentity' => $gamerIdentity, 'gamertype' => $gamerType]);
        } catch (\Exception $ex) {
            return false;
        }
    }

    /**
     * Returns Gamerinstance from database, or creates one if doesn't exist, using the createInstance method of Gamerinstance.php
     * 
     * @param object $gamerIdentity
     * @param object $gamerType
     * @return object
     */
    public function getInstance($gamerIdentity, $gamerType) {
        $gamerInstance = $this->checkInstance($gamerIdentity, $gamerType);
        if (!$gamerInstance) {
            $gamerInstance = $this->createInstance($gamerIdentity, $gamerType);
        }
        return $gamerInstance;
    }

    
    /**
     * Creates an Gamerinstance, using the gamerIdentity and gamerType provided.
     * 
     * @param type $gamerIdentity
     * @param type $gamerType
     * @return type
     */
    public function createInstance($gamerIdentity, $gamerType) {
        $classNameModel = $this->container->get('model_factory')->getModel('TMSolution\GamificationBundle\Entity\Objecttype');
        $classNameObject = $classNameModel->findOneById($gamerType);
        $entityObjectInstance = new EntityObjectInstance();
        $entityObjectInstance->setObjecttype($classNameObject);
        $entityObjectInstance->setObjectidentity($gamerIdentity);
        return $this->create($entityObjectInstance, true);
    }
}
