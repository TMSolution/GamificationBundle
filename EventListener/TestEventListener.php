<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TestEventListener
 *
 * @author Lukasz
 */

namespace TMSolution\GamificationBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseForResEvent;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class TestEventListener {

    public function onKernelResponse(FilterResponseEvent $event) {
        $response = $event->getResponse();
        //$request = $event->getRequest();
          $response->headers->replace("test");
           $event->setResponse($response);
        dump($response);
        exit;
//        $message = sprintf(
//                'My Response says: %s with code: %s', $response->getMessage(), $response->getCode()
//        );
    }

}
