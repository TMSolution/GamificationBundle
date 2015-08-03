<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GamificationExceptionListener
 *
 * @author Lukasz
 */

namespace TMSolution\GamificationBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\Response;

class GamificationExceptionListener {

//    public function onKernelException(GetResponseForExceptionEvent $event) {
//        // We get the exception object from the received event
//        $exception = $event->getException();
//        $message = 'My Error says: ' . $exception->getMessage();
//
//        // Customize our response object to display our exception details
//        $response = new Response();
//        $response->setContent($message);
//        //$response->setStatusCode($exception->getStatusCode());
//
//        // Send our modified response object to the event
//        $event->setResponse($response);
//    }

}
