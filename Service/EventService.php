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
use Symfony\Component\HttpFoundation\Response;

class EventService
{

    protected $container;

    public function __construct($container)
    {

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
    public function register($eventId, $objectIdentity, $classId)
    {

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
    public function addObjectTrophy($objectType, $trophy)
    {

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
    public function getObjectTrophies($objectInstance, $trophyCategory = null)
    {
        $objectTrophyModel = $this->container->get('model_factory')
                ->getModel('TMSolution\GamificationBundle\Entity\Objecttrophy');
        if ($trophyCategory != null) {
            $result = $objectTrophyModel->findBy(['object' => $objectInstance, 'trophy' => $trophyCategory]);
        } else {
            $result = $objectTrophyModel->findBy(['object' => $objectInstance]);
        }

        return $result;
    }

    public function checkRule($objectInstanceId, $trophyId, $ruleId)
    {
        $model = $this->container->get('model_factory');
        $objectInstanceModel = $model->getModel('TMSolution\GamificationBundle\Entity\Objectinstance');
        $objectTrophyModel = $model->getModel('TMSolution\GamificationBundle\Entity\Trophy');
        $objectRuleModel = $model->getModel('TMSolution\GamificationBundle\Entity\Rule');
        $objectInstancePointsModel = $model->getModel('TMSolution\GamificationBundle\Entity\ObjectInstancePoints');


        $objectInstance = $objectInstanceModel->findOneById($objectInstanceId);
        $objectTrophy = $objectTrophyModel->findOneById($trophyId);

        $objectRule = $objectRuleModel->findOneById($ruleId);
        $objectPoints = $objectInstancePointsModel->findOneBy(['objectid' => $objectInstanceId]);

        $points = $objectPoints->getOverall1();

        if ($objectTrophy->getTrophytype()->getId() == 1/* Jednorazowa */) {
            $rule = $objectRule->getContext() . " " . $objectRule->getOperator() . " " . $objectRule->getValue();
            $context = new Context();
            $context[$objectRule->getContext()] = $points;
            $ruler = new Ruler();

            if ($ruler->assert($rule, $context) == true) {
                if ($objectPoints->getOneusedTrophy() == 0) {
                    $var = $objectPoints->setOneusedTrophy(1);
                    $objectInstancePointsModel->update($var, true);
                }
            } else {}
        } elseif ($objectTrophy->getTrophytype()->getId() == 2/* Cykliczna */) {
            $rule = $objectRule->getContext() . " " . $objectRule->getOperator() . " " . $objectRule->getValue();
            $context = new Context();
            $context[$objectRule->getContext()] = $points;
            $ruler = new Ruler();

            if ($ruler->assert($rule, $context) == true) {
                $pointsUnused = $points - ($objectPoints->getCyclicTrophy() * 3);
                

                $newCyclicTrophy = intval($pointsUnused / 3);
                $trophiesObtained = $objectPoints->getCyclicTrophy();
                $var = $objectPoints->setCyclicTrophy($trophiesObtained + $newCyclicTrophy);
                $objectInstancePointsModel->update($var, true);
            } else {}
        }

        return new Response('Operation complete');
    }

}
