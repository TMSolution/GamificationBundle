<?php

/**
 * Gamerinstance, business logic for the service.
 *
 * @author Jacek Łoziński
 */

namespace TMSolution\GamificationBundle\Model;

use TMSolution\GamificationBundle\Entity\GamerInstanceInterface as EntityGamerInstance;
use Core\ModelBundle\Model\Model as BaseModel;

class GamerTrophy extends BaseModel
{

    protected $eventName;
    protected $gamerInstance;
    protected $gamerTrophies;

    public function __construct($container, $entityName, $eventName)
    {
        parent::__construct($container, $entityName, null, null);
        $this->eventName = $eventName;
    }

    public function register()
    {
        $gamerInstance = $this->getUser();
        //register event
        $event = $this->registerEvent();

        if ($event) {

            //register log
            $eventLog = $this->registerLog($gamerInstance, $event);
            //registert counter
            $eventCounter = $this->registerCounter($gamerInstance, $event);
            //check trophy
            $newGamerTrophies = $this->checkGamerTrophy($gamerInstance, $event, $eventCounter);
            //check and add user level
            $this->checkGamerLevel($gamerInstance);
        }
    }

    protected function checkGamerLevel($gamerInstance)
    {
        $gamerInstanceLevel = $gamerInstance->getCurrentLevel();
        $gamerInstancePoints = $gamerInstance->getCurrentPoints();

        $levelModel = $this->container->get('model_factory')->getModel('TMSolution\GamificationBundle\Entity\Level');
        $availableLevel = $levelModel->getRepository()->findOneLevelByPoints($gamerInstancePoints);

        if ($gamerInstanceLevel->getId() < $availableLevel->getId()) {
            $gamerInstance->setCurrentLevel($availableLevel);
            $this->update($gamerInstance, true);
        }
    }

    protected function registerEvent()
    {

        $eventCategoryModel = $this->container->get('model_factory')->getModel('TMSolution\GamificationBundle\Entity\GamificationEventCategory');
        $eventCategory = $eventCategoryModel->findOneById(1);

        $eventModel = $this->container->get('model_factory')->getModel('TMSolution\GamificationBundle\Entity\GamificationEvent');
        try {
            $event = $eventModel->findOneBy(['name' => $this->eventName]);
        } catch (\Exception $e) {
            return false;
        }
        return $event;
    }

    protected function registerCounter($gamerInstance, $event)
    {
        $eventCounterModel = $this->container->get('model_factory')->getModel('TMSolution\GamificationBundle\Entity\GamificationEventCounter');
        try {
            $eventCounter = $eventCounterModel->findOneBy(['event' => $event, 'gamerInstance' => $gamerInstance]);
            $eventCounter->setCounter($eventCounter->getCounter() + 1);
            $eventCounterModel->update($eventCounter, true);
        } catch (\Exception $e) {
            $eventCounter = $eventCounterModel->getEntity();
            $eventCounter->setGamerInstance($gamerInstance);
            $eventCounter->setCounter(1);
            $eventCounter->setEvent($event);
            $eventCounterModel->create($eventCounter, true);
        }
        return $eventCounter;
    }

    protected function registerLog($gamerInstance, $event)
    {
        $eventLogModel = $this->container->get('model_factory')->getModel('TMSolution\GamificationBundle\Entity\GamificationEventLog');
        $eventLog = $eventLogModel->getEntity();
        $eventLog->setGamerInstance($gamerInstance);
        $eventLog->setDate(new \DateTime('now'));
        $eventLog->setEvent($event);
        $eventLogModel->create($eventLog, true);
        return $eventLog;
    }

    protected function getGamerTrophies($gamerInstance)
    {
        $gamerTrophiesConfArray = [];

        $this->gamerTrophies = $this->findBy(['gamerInstance' => $gamerInstance]);
        foreach ($this->gamerTrophies as $gamerTropy) {
            $gamerTrophiesConfArray[$gamerTropy->getTrophyConfiguration()->getId()] = $gamerTropy->getTrophy();
        }
        return $gamerTrophiesConfArray;
    }

    protected function checkGamerTrophy($gamerInstance, $event, $eventCounter)
    {
        $newGamerTrophies = [];
        $trophies = $event->getTrophies();

        foreach ($trophies as $trophy) {

            array_merge($newGamerTrophies, $this->checkGamerTrophyConfiguration($gamerInstance, $trophy, $eventCounter));
        }

        return $newGamerTrophies;
    }

    protected function checkGamerTrophyConfiguration($gamerInstance, $trophy, $eventCounter)
    {
        $newGamerTrophies = [];
        $trophyConfigurations = $trophy->getConfigurations();
        $gamerTrophiesConfigurationArray = $this->getGamerTrophies($gamerInstance);
        foreach ($trophyConfigurations as $trophyConfiguration) {

            $trophyMultiplicity = $trophyConfiguration->getMultiplicity();

            if ($eventCounter->getCounter() >= $trophyMultiplicity && !array_key_exists($trophyConfiguration->getId(), $gamerTrophiesConfigurationArray)) {
                $newGamerTrophies[] = $this->addGamerTrophy($gamerInstance, $trophy, $trophyConfiguration);
            }
        }
        return $newGamerTrophies;
    }

    public function addGamerTrophy($gamerInstance, $trophy, $trophyConfiguration)
    {


        if ($gamerInstance && $trophy) {
            $gamerTrophy = $this->getEntity();
            $gamerTrophy->setDate(new \DateTime('NOW'))
                    ->setGamerinstance($gamerInstance)
                    ->setTrophy($trophy)
                    ->setTrophyCategory($trophy->getTrophyCategory())
                    ->setTrophyConfiguration($trophyConfiguration)
                    ->setPosition($trophy->getPosition());
            $this->create($gamerTrophy, true);

            $this->addGamerPoints($gamerInstance, $trophyConfiguration);
            $this->pushGamerTrophy($gamerInstance, $trophy, $trophyConfiguration);
            return $gamerTrophy;
        }
    }

    protected function addGamerPoints($gamerInstance, $trophyConfiguration)
    {
        $newGamerPoints = $gamerInstance->getCurrentPoints() + $trophyConfiguration->getPoints();
        $gamerInstance->setCurrentPoints($newGamerPoints);
        $this->update($gamerInstance, true);
    }

    protected function pushGamerTrophy($gamerInstance, $trophy, $trophyConfiguration)
    {
        $pusher = $this->container->get('gos_web_socket.wamp.pusher');
        $data = [
            "name" => $trophy->getName(),
            "description" => $trophy->getDescription(),
            "level" => $trophyConfiguration->getLevel(),
            "points" => $trophyConfiguration->getPoints(),
            "gamerInstanceId" => $gamerInstance->getId(),
            "currentPoints" => $gamerInstance->getCurrentPoints(),
            "prefixClass" => $trophy->getPrefixClass()
        ];
        $pusher->push($data, 'gamification_pusher', []);
    }

}
