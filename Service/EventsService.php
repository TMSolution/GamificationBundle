<?php

namespace TMSolution\GamificationBundle\Service;

use TMSolution\GamificationBundle\Entity\Eventlog;
use TMSolution\GamificationBundle\Entity\Eventcounter;
use TMSolution\GamificationBundle\Entity\Objecttrophy;
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
class EventsService
{

    protected $container;
    protected $model;
    protected $objectInstanceModel;
    protected $eventModel;
    protected $eventLogModel;
    protected $eventCounterModel;
    protected $objectTrophyModel;
    protected $ruleModel;
    protected $contextModel;
    protected $trophyModel;

    public function __construct($container)
    {
        $this->container = $container;
        $this->model = $this->container->get('model_factory');
        $this->objectInstance = $this->model->getModel('TMSolution\GamificationBundle\Entity\Objectinstance');
        $this->eventModel = $this->model->getModel('TMSolution\GamificationBundle\Entity\Event');
        $this->eventLogModel = $this->model->getModel('TMSolution\GamificationBundle\Entity\Eventlog');
        $this->eventCounterModel = $this->model->getModel('TMSolution\GamificationBundle\Entity\Eventcounter');
        $this->objectTrophyModel = $this->model->getModel('TMSolution\GamificationBundle\Entity\Objecttrophy');
        $this->ruleModel = $this->model->getModel('TMSolution\GamificationBundle\Entity\Rule');
        $this->contextModel = $this->model->getModel('TMSolution\GamificationBundle\Entity\Context');
        $this->trophyModel = $this->model->getModel('TMSolution\GamificationBundle\Entity\Trophy');
    }

    /**
     * The method registers events in the database. 
     * In case the person for whom the event to be registered exists, the function 
     * creates a new entry in the db and increments the counter.
     * If the object exists, the method increments a counter.
     * 
     * 
     * @param integer $eventCategoryId
     * @param integer $objectIdentity
     * @param integer $classId
     * 
     */
    public function register($eventCategoryId, $objectIdentity, $classId)
    {
        $objectInstance = $this->objectInstanceModel->getInstance($objectIdentity, $classId);
        if ($objectInstance) {
            $event = $this->eventModel->findOneById($eventCategoryId);
            $eventLogEntity = new Eventlog();
            $eventLogEntity->setEvent($event)
                    ->setObjectInstance($objectInstance)
                    ->setDate(new \DateTime('NOW'));
            $this->eventLogModel->create($eventLogEntity, true);
            try {
                $eventCounterEntity = $this->eventCounterModel->findOneBy(['event' => $event, 'objectInstance' => $objectInstance]);
                $eventCounterEntity->setCounter($eventCounterEntity->getCounter() + 1);
                $this->eventCounterModel->update($eventCounterEntity, true);
            } catch (\Exception $e) {
                $eventCounterEntity = new Eventcounter();
                $eventCounterEntity->setEvent($event);
                $eventCounterEntity->setObjectInstance($objectInstance);
                $eventCounterEntity->setCounter($eventCounterEntity->getCounter() + 1);
                $this->eventCounterModel->update($eventCounterEntity, true);
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
            $objectTrophy = $this->objectTrophyModel->getEntity();
            $objectTrophy->setDate(new \DateTime('NOW'))
                    ->setObject($objectType)
                    ->setTrophy($trophy);
            $this->objectTrophyModel->create($objectTrophy, true);
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
    public function getObjectTrophies($objectInstance, $trophyCategory = null)
    {
        if ($trophyCategory != null) {
            $result = $this->objectTrophyModel->findBy(['object' => $objectInstance, 'trophy' => $trophyCategory]);
        } else {
            $result = $this->objectTrophyModel->findBy(['object' => $objectInstance]);
        }
        return $result;
    }

    /* Błąd projektowy - nagroda cykliczna nie może być przyznawana co 2 wystąpienia, ponieważ jej podstawą są przyznane wcześniej nagrody cykliczne.
     * Oznacza to, że nagroda przyznaje się, sprawdzając samą siebie, oraz że nigdy nie zostanie osiągnięta, ponieważ nigdy nie spełni początkowego warunku
     * i nie wyjdzie poza początkową wartość, o ile ta nie zostanie w sztuczny sposób podniesiona. Na tą chwilę jest przyznawana za każdym razem.
     */
 
    public function checkRule($objectInstance, $trophy)
    {
        $objectRule = $this->ruleModel->getRepository()->findOneBy(['trophy' => $trophy]);
        $objectContext = $this->contextModel->getRepository()->findOneBy(['id' => $objectRule->getContext()]);        
        $trophyCount = $this->countTrophies($objectInstance, $trophy);
        $cyclicCount = $this->countCyclicTrophies($objectInstance);
        $assertion = $this->assertion($objectContext->getName(), $objectRule->getOperator(), $objectRule->getValue(), $cyclicCount);

        if ($trophy->getTrophytype()->getId() == 1/* Jednorazowa */) {
            if (($assertion == true) && ($trophyCount == 0)) {
                $objectTrophy = $this->createObjecttrophy($objectInstance, $trophy);
                $this->objectTrophyModel->create($objectTrophy, true);
                return new Response('Nagroda jednorazowa przyznana');
            } elseif ($trophyCount != 0) {
                return new Response('Posiadasz już tą nagrodę jednorazową.');
            } else {
                return new Response('Nagroda jednorazowa nie przyznana');
            }
        } elseif ($trophy->getTrophytype()->getId() == 2/* Cykliczna */) {
            if ($assertion == true) {
                $objectTrophy = $this->createObjecttrophy($objectInstance, $trophy);
                $this->objectTrophyModel->create($objectTrophy, true);
                return new Response("Nagroda cykliczna przyznana. Obecnie masz $cyclicCount nagród tego typu.");
            } else {
                return new Response('Nagroda cykliczna nie przyznana.');
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

    public function countTrophies($objectInstance, $trophy)
    {
        $trophiesArray = $this->objectTrophyModel->findBy(['object' => $objectInstance, 'trophy' => $trophy]);
        $count = count($trophiesArray);
        return $count;
    }
    //niedokończona
    public function createObjecttrophy($objectInstance, $trophy)
    {
        $objectTrophy = new Objecttrophy();
        $objectTrophy->setDate(new \DateTime('NOW'))
                ->setObject($objectInstance)
                ->setTrophy($trophy);
        $ot = $this->objectTrophyModel->create($objectTrophy, true);
        return $ot;
    }

    // Do zrobienia
    public function computeContextValue($objectInstance, $trophy)
    {
        
    }

    public function countCyclicTrophies($objectInstance)
    {
        $cyclicTrophy = $this->trophyModel->findOneById(2);
        $cyclicTrophies = $this->countTrophies($objectInstance, $cyclicTrophy);
        return $cyclicTrophies;
    }

}
