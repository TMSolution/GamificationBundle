<?php

namespace TMSolution\GamificationBundle\Service;

use TMSolution\GamificationBundle\Entity\Eventlog;
use TMSolution\GamificationBundle\Entity\Eventcounter;
use TMSolution\GamificationBundle\Entity\Objecttrophy;
use TMSolution\GamificationBundle\Entity\Trophy;
use TMSolution\GamificationBundle\Entity\Classname;
use TMSolution\GamificationBundle\Entity\Objectinstance;
use Core\ModelBundle\Model\Model;
use Hoa\Ruler\Ruler;
use Hoa\Ruler\Context;

class EventService {

    protected $container;

    public function __construct($container) {

        $this->container = $container;
    }

    /**
     * Description of EventService service
     *
     * @author Damian Piela <damian.piela@tmsolution.pl>
     * @author Lukasz Sobieraj <lukasz.sobieraj@tmsolution.pl>
     * @author Jacek Lozinski <jacek.lozinski@tmsolution.pl>

     */

    /**
     * The method registers events in the database. 
     * In case the person for whom the event to be registered exists, the function 
     * creates a new entry in the db and increments the counter.
     * If the object exists, the method increments a counter.
     * 
     * 
     * @param integer $eventId
     * @param integer $objectIdentity
     * @param integer $classId
     * 
     */
    public function register($eventId, $objectIdentity, $classId) {

        $objectInstanceModel = $this->container->get('model_factory')->getModel('TMSolution\GamificationBundle\Entity\Objectinstance');
        $objectInstance = $objectInstanceModel->getInstance($objectIdentity, $classId);
        if ($objectInstance) {

            $eventModel = $this->container->get('model_factory')->getModel('TMSolution\GamificationBundle\Entity\Event');
            $event = $eventModel->findOneById($eventId);

            $eventLogModel = $this->container->get('model_factory')->getModel('TMSolution\GamificationBundle\Entity\Eventlog');
            $eventLogEntity = new Eventlog();
            $eventLogEntity->setEvent($event);
            $eventLogEntity->setObjectInstance($objectInstance);
            $eventLogEntity->setDate(new \DateTime('NOW'));
            $eventLogModel->create($eventLogEntity, true);

            $eventCounterModel = $this->container->get('model_factory')->getModel('TMSolution\GamificationBundle\Entity\Eventcounter');
            try {
                $eventCounterEntity = $eventCounterModel->findOneBy(['eventid' => $event, 'objectInstanceId' => $objectInstance]);
            } catch (\Exception $ex) {
                $eventCounterEntity = new Eventcounter();
            }
            $eventCounterEntity->setEvent($event);
            $eventCounterEntity->setObjectInstance($objectInstance);
            $eventCounterEntity->setCounter($eventCounterEntity->getCounter() + 1);
            $eventCounterModel->update($eventCounterEntity, true);
        }
    }

    /**
     * Function, upon ensuring that input data is correct, creates a new entity which represents
     * a single entry in the objecttrophy database table.
     * Additionally, it returns the object it has created, allowing for a more strict operation control.
     * 
     * @param object $objectInstance
     * @param object $trophy
     * @return Objecttrophy $objectTrophy
     */
    public function addObjectTrophy($objectType, $trophy) {

        if ($objectType && $trophy) {

            $objectTrophyModel = $this->container->get('model_factory')
                    ->getModel('TMSolution\GamificationBundle\Entity\Objecttrophy');

            $objectTrophy = new Objecttrophy();
            $objectTrophy->setDate(new \DateTime('NOW'));
            $objectTrophy->setObject($objectType);
            $objectTrophy->setTrophy($trophy);

            $objectTrophyModel->create($objectTrophy, true);

            return $objectTrophy;
        }
    }

    /**
     * Looks for user's trophies in the database, if the $trophyCategory paramenter is given, 
     * the returned results are of the given type.
     * Otherwise, it returns all the trophies of that particular user.
     * The result is an array, which is the result obtained from the database.
     * 
     * @param object $objectInstance
     * @param object $troptrophyCategory
     * @return array $result
     */
    public function getObjectTrophies($objectInstance, $trophyCategory = null) {
        $objectTrophyModel = $this->container->get('model_factory')
                ->getModel('TMSolution\GamificationBundle\Entity\Objecttrophy');
        if ($trophyCategory != null) {
            $result = $objectTrophyModel->findBy(['object' => $objectInstance, 'trophy' => $trophyCategory]);
        } else {
            $result = $objectTrophyModel->findBy(['object' => $objectInstance]);
        }

        return $result;
    }

    public function checkRule($objectInstanceId, $trophyId, $ruleId) {
        /* $model = $this->get('model_factory');
          $objectTrophyModel = $model->getModel('TMSolution\GamificationBundle\Entity\Objecttrophy');
          $array = ['object' => $objectId];
          $objectTrophyInstance = $objectTrophyModel->findBy($array);
          $count = count($objectTrophyInstance);

          //dump($count);exit;
          $ruleMo = $this->get('model_factory');
          $ruleModel = $ruleMo->getModel('TMSolution\GamificationBundle\Entity\Rule');
          $ruleRecord = $ruleModel->findBy(['id' => $ruleId]);
          $rule = $ruleRecord[0]->getName();

          $ruler = new Ruler();
          $context = new Context();
          $context['points'] = $count;

          $result = $ruler->assert($rule, $context);

          if ($result) {
          $objectInstanceMo = $this->get('model_factory');
          $objectInstanceModel = $objectInstanceMo->getModel('TMSolution\GamificationBundle\Entity\Objectinstance');
          $objectInstanceArray = $objectInstanceModel->findBy(['id' => $objectId]);
          $objectInstance = $objectInstanceArray[0];

          $newObjectTrophy = new Objecttrophy();
          $newObjectTrophy->setDate(new \DateTime('NOW'));
          $newObjectTrophy->setObject($objectInstance);


          $trophyMo = $this->get('model_factory');
          $trophyModel = $trophyMo->getModel('TMSolution\GamificationBundle\Entity\Trophy');

          $trophyArray = $trophyModel->findBy(['id' => 2]);
          $trophy = $trophyArray[0];
          $newObjectTrophy->setTrophy($trophy);

          $objectTrophyModel->create($newObjectTrophy, true);

          return new Response("operation complete");

          } */

        $model = $this->container->get('model_factory');
        
        $objectInstanceModel = $model->getModel('TMSolution\GamificationBundle\Entity\Objectinstance');
        $objectTrophyModel = $model->getModel('TMSolution\GamificationBundle\Entity\Trophy');
        //$objectTrophyTypeModel = $model->getModel('TMSolution\GamificationBundle\Entity\Trophytype');
        $objectRuleModel = $model->getModel('TMSolution\GamificationBundle\Entity\Rule');

        $objectInstance = $objectInstanceModel->findOneById($objectInstanceId);
        $objectTrophy = $objectTrophyModel->findOneById($trophyId);
        $objectRule = $objectRuleModel->findOneById($ruleId);
        $points = 12;
        //$objectRuleParams = ['context' => $objectRule->getContext(), 'operator' => $objectRule->getOperator(), 'value' => $objectRule->getValue()];

        if ($objectTrophy->getTrophytype()->getId() == 1/* Jednorazowa */) {
            $rule = $objectRule->getContext() . " " . $objectRule->getOperator() . " " . $objectRule->getValue();
            $context = new Context();
            $context[$objectRule->getContext()] = $points;
            $ruler = new Ruler();
            $previousAwards;
            
            if($ruler->assert($rule, $context) == true){
                return true;
            }else{
                return false;
            }
            
            dump($rule); exit;
            $objectTrophyInstance = $objectTrophyModel->findBy($array);
        } elseif ($trophy->trophytype == 2/* Cykliczna */) {
            
            
        }
    }

}
