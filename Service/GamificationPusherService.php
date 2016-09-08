<?php

/**
 * GamificationPusherService service
 *
 * @author Damian Piela <damian.piela@tmsolution.pl>
 * @author Lukasz Sobieraj <lukasz.sobieraj@tmsolution.pl>
 * @author Jacek Lozinski <jacek.lozinski@tmsolution.pl>
 */

namespace TMSolution\GamificationBundle\Service;

use Gos\Bundle\WebSocketBundle\Periodic\PeriodicInterface;
use Gos\Bundle\WebSocketBundle\Topic\PushableTopicInterface;
use Gos\Bundle\WebSocketBundle\Topic\TopicInterface;
use Gos\Bundle\WebSocketBundle\Client\ClientManipulatorInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Wamp\Topic;
use Gos\Bundle\WebSocketBundle\Router\WampRequest;

class GamificationPusherService implements TopicInterface, PushableTopicInterface, PeriodicInterface
{

    protected $clientManipulator;
    protected $container;
    protected $model;

    public function __construct(ClientManipulatorInterface $clientManipulator, $container)
    {
        $this->clientManipulator = $clientManipulator;
        $this->container = $container;
        $this->model = $this->container->get('model_factory');
        $this->gamerTrophyModel = $this->model->getModel('TMSolution\GamificationBundle\Entity\GamerTrophy');
        $this->trophyModel = $this->model->getModel('TMSolution\GamificationBundle\Entity\Trophy');
    }

    public function tick()
    {
        echo "Executed once every 5 seconds" . PHP_EOL;
    }

    public function getTimeout()
    {
        return 10;
    }

    /**
     * This will receive any Subscription requests for this topic.
     *
     * @param ConnectionInterface $connection
     * @param Topic $topic
     * @param WampRequest $request
     * @return void
     */
    public function onSubscribe(ConnectionInterface $connection, Topic $topic, WampRequest $request)
    {
//           
        $user = $this->clientManipulator->getClient($connection);
        echo "subscribe" . PHP_EOL;
        //dump($user);
//           $logger = $this->get('logger');
//           $logger->info('I just got the logger');
//           $logger->error('An error occurred');
        //$user = $this->clientManipulator->getClient($connection);

        /* foreach ($topic as $client) {
          //Do stuff ...

          $client->event($topic->getId(), ['msg' => 'lol']);
          }

          // dump($user);
          //this will broadcast the message to ALL subscribers of this topic.
          $topic->broadcast(['msg' => $connection->resourceId . " has joined " . $topic->getId()]);

          @var ConnectionPeriodicTimer $topicTimer
          $topicTimer = $connection->PeriodicTimer;

          //Add periodic timer
          $topicTimer->addPeriodicTimer('hello', 2, function() use ($topic, $connection) {
          $connection->event($topic->getId(), ['msg' => 'hello world']);
          });

          //exist
          $topicTimer->isPeriodicTimerActive('hello'); //true or false
          //Remove periodic timer
          $topicTimer->cancelPeriodicTimer('hello'); */
    }

    /**
     * This will receive any UnSubscription requests for this topic.
     *
     * @param ConnectionInterface $connection
     * @param Topic $topic
     * @param WampRequest $request
     * @return void
     */
    public function onUnSubscribe(ConnectionInterface $connection, Topic $topic, WampRequest $request)
    {
        //this will broadcast the message to ALL subscribers of this topic.
        // $topic->broadcast(['msg' => $connection->resourceId . " has left " . $topic->getId()]);
    }

    /**
     * This will receive any Publish requests for this topic.
     *
     * @param ConnectionInterface $connection
     * @param Topic $topic
     * @param WampRequest $request
     * @param $event
     * @param array $exclude
     * @param array $eligible
     * @return mixed|void
     */
    public function onPublish(ConnectionInterface $connection, Topic $topic, WampRequest $request, $event, array $exclude, array $eligible)
    {

        if (!is_array($event)) {
            $event = json_decode($event, true);
        }

        echo "publish " . count($topic) . " " . PHP_EOL;

        if (array_key_exists('gamerInstanceId', $event) && $event['gamerInstanceId']) {
            echo $event['gamerInstanceId'] . PHP_EOL;
            $gamerInstance = $this->getUserById($event['gamerInstanceId']);
            // echo $gamerInstance->getUserName() . PHP_EOL;
            $user = $this->clientManipulator->findByUsername($topic, $gamerInstance->getUserName());

            $data = [
                "name" => $event["name"],
                "description" => $event["description"],
                "level" => $event["level"],
                "points" => $event["points"],
                "currentPoints" => $event["currentPoints"],
                "prefixClass" => $event["prefixClass"]
            ];

            //if (false !== $user) {
            $topic->broadcast($data, array()/* , array($user['connection']->WAMP->sessionId) */);
            //}
        }
    }

    public function onPush(Topic $topic, WampRequest $request, $data, $provider)
    {
        // NOT WORKING ON WAMP PUSHER
    }

    public function getName()
    {
        return 'gamification.pusher';
    }

    protected function getUserById($gamerInstanceId)
    {
        $userModel = $this->container->get('model_factory')->getModel('CCO\UserBundle\Entity\User');
        $user = $userModel->findOneById($gamerInstanceId);
        if (false !== $user) {
            return $user;
        }
        return false;
    }

}
