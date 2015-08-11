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

/**
 * Description of EventService service
 *
 * @author Damian Piela <damian.piela@tmsolution.pl>
 * @author Lukasz Sobieraj <lukasz.sobieraj@tmsolution.pl>
 * @author Jacek Lozinski <jacek.lozinski@tmsolution.pl>
 */
class EventService
{

    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

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
    public function register($eventCategoryId, $objectIdentity, $classId)
    {
        $objectInstance = $this->container->get('model_factory')->getModel('TMSolution\GamificationBundle\Entity\Objectinstance')->getInstance($objectIdentity, $classId);
        if ($objectInstance) {
            $event = $this->container->get('model_factory')->getModel('TMSolution\GamificationBundle\Entity\Event')->findOneById($eventCategoryId);
            $eventLogModel = $this->container->get('model_factory')->getModel('TMSolution\GamificationBundle\Entity\Eventlog');
            $eventLogEntity = new Eventlog();
            $eventLogEntity->setEvent($event)
                    ->setObjectInstance($objectInstance)
                    ->setDate(new \DateTime('NOW'));
            $eventLogModel->create($eventLogEntity, true);
            $eventCounterModel = $this->container->get('model_factory')->getModel('TMSolution\GamificationBundle\Entity\Eventcounter');
            try {
                $eventCounterEntity = $eventCounterModel->findOneBy(['event' => $event, 'objectInstance' => $objectInstance]);
                $eventCounterEntity->setCounter($eventCounterEntity->getCounter() + 1);
                $eventCounterModel->update($eventCounterEntity, true);
            } catch (\Exception $e) {
                $eventCounterEntity = new Eventcounter();
                $eventCounterEntity->setEvent($event);
                $eventCounterEntity->setObjectInstance($objectInstance);
                $eventCounterEntity->setCounter($eventCounterEntity->getCounter() + 1);
                $eventCounterModel->update($eventCounterEntity, true);
            }
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
            $objectTrophyModel = $this->container->get('model_factory')->getModel('TMSolution\GamificationBundle\Entity\Objecttrophy');
            $objectTrophy = new Objecttrophy();
            $objectTrophy->setDate(new \DateTime('NOW'))
                    ->setObject($objectType)
                    ->setTrophy($trophy);
            $objectTrophyModel->create($objectTrophy, true);
            return $objectTrophy;
        }
    }

//end of addObjectTrophy

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

    public function checkRule($objectInstance, $trophy, $points /* zmienna do testow */)
    {

        $model = $this->container->get('model_factory');
        $ruleModel = $model->getModel('TMSolution\GamificationBundle\Entity\Rule');
        $contextModel = $model->getModel('TMSolution\GamificationBundle\Entity\Context');
        $objectRule = $ruleModel->getRepository()->findOneBy(['trophy' => $trophy]);
        $objectContext = $contextModel->getRepository()->findOneBy(['id' => $objectRule->getContext()]);



        $assertion = $this->assertion($objectContext->getName(), $objectRule->getOperator(), $objectRule->getValue(), $points);
        if ($trophy->getTrophytype()->getId() == 1/* Jednorazowa */) {
            if ($assertion == true) {
                return new Response('Jednorazowa przyznana');
            } else {
                return new Response('Jednorazowa nie przyznana');
            }
        } elseif ($trophy->getTrophytype()->getId() == 2/* Cykliczna */) {
            if ($assertion == true) {
                $currentTrophies = count($objectInstance); //Nie patrzy na rodzaj nagrody. Nie wiadomo, na co wpływa
                return new Response('Cykliczna przyznana');
            } else {
                return new Response('Cykliczna nie przyznana');
            }
        }
    }

    public function assertion($context, $operator, $value, $contextValue)
    {
        $ruler = new Ruler();
        $cont = new Context();
        $rule = $context . " " . $operator . " " . $value;
        $cont[$context] = $contextValue;
        return $ruler->assert($rule, $cont);
    }

    public function count($objectInstance)
    {

        $model = $this->container->get('model_factory');
        $objectInstanceModel = $model->getModel('TMSolution\GamificationBundle\Entity\Objecttrophy');
        $objectInstanceObject = $objectInstanceModel->findOneById($objectInstance->getObjectIdentity());
        $count = count($objectInstanceObject);
        return $count;
    }

}
