<?php

/**
 * Gamerinstance, business logic for the service.
 *
 * @author Damian Piela
 * @author Lukasz Sobieraj
 */

namespace TMSolution\GamificationBundle\Model;

use TMSolution\GamificationBundle\Entity\GamerInstanceInterface as EntityGamerInstance;
use Core\ModelBundle\Model\Model as BaseModel;

class GamerTrophy extends BaseModel
{

    public function addGamerTrophy()
    {
        $trophyModel = $this->container->get('model_factory')->getModel('TMSolution\GamificationBundle\Entity\Trophy');
        $trophy = $trophyModel->findOneById(1);

        $gamerInstance = $this->getUser();

        if ($gamerInstance && $trophy) {
            $gamerTrophy = $this->getEntity();
            $gamerTrophy->setDate(new \DateTime('NOW'))
                    ->setGamerinstance($gamerInstance)
                    ->setTrophy($trophy)
                    ->setTrophyCategory($trophy->getTrophyCategory())
                    ->setPosition($trophy->getPosition());
            $this->create($gamerTrophy, true);

            $this->pushGamerTrophy($trophy, $gamerInstance);
            return $gamerTrophy;
        }
    }

    protected function pushGamerTrophy($trophy, $gamerInstance)
    {
        $pusher = $this->container->get('gos_web_socket.wamp.pusher');
        $data = [ "name" => $trophy->getName(), "description" => $trophy->getDescription(), "gamerInstanceId" => $gamerInstance->getId()];
        $pusher->push($data, 'gamification_pusher', []);
    }

}
