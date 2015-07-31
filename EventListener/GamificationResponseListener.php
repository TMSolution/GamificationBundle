<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GamificationResponseListener
 *
 * @author Lukasz
 */

namespace TMSolution\GamificationBundle\EventListener;

use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpFoundation\Response;

class GamificationResponseListener {

    //put your code here

    public function onKernelResponse(FilterResponseEvent $event) {
        
        $response = $event->getResponse();
        $answer = new Response();
        $answer->setContent('My response says: ' . $response->getContent());
        $event->setResponse($answer);
    }

}
