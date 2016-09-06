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
use Ratchet\ConnectionInterface;
use Ratchet\Wamp\Topic;
use Gos\Bundle\WebSocketBundle\Router\WampRequest;

class GamificationPusherService implements TopicInterface, PushableTopicInterface, PeriodicInterface
{

    protected $container;
    protected $model;

    public function __construct($container)
    {
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
//           $logger = $this->get('logger');
//           $logger->info('I just got the logger');
//           $logger->error('An error occurred');
        // $user = $this->clientManipulator->getClient($connection);

        foreach ($topic as $client) {
            //Do stuff ...

            $client->event($topic->getId(), ['msg' => 'lol']);
        }

        // dump($user);
        //this will broadcast the message to ALL subscribers of this topic.
        $topic->broadcast(['msg' => $connection->resourceId . " has joined " . $topic->getId()]);

        /** @var ConnectionPeriodicTimer $topicTimer */
        $topicTimer = $connection->PeriodicTimer;

        //Add periodic timer
        $topicTimer->addPeriodicTimer('hello', 2, function() use ($topic, $connection) {
            $connection->event($topic->getId(), ['msg' => 'hello world']);
        });

        //exist
        $topicTimer->isPeriodicTimerActive('hello'); //true or false
        //Remove periodic timer
        $topicTimer->cancelPeriodicTimer('hello');
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
        $topic->broadcast(['msg' => $connection->resourceId . " has left " . $topic->getId()]);
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
        
        $this->message = $event['msg'];
        $topic->broadcast([
            'msg' => $event['msg']
        ]);
    }

    public function onPush(Topic $topic, WampRequest $request, $data, $provider)
    {
        
    }

    /**
     * Like RPC is will use to prefix the channel
     * @return string
     */
    public function getName()
    {
        return 'gamification.pusher';
    }

}
