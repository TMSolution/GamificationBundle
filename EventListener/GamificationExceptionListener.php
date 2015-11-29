<?php


/**
 * Description of GamificationExceptionListener
 *
 * @author Lukasz
 */

namespace TMSolution\GamificationBundle\GamificationEventListener;

use Symfony\Component\HttpKernel\GamificationEvent\GetResponseForExceptionGamificationEvent;
use Symfony\Component\HttpFoundation\Response;

class GamificationExceptionListener {

//    public function onKernelException(GetResponseForExceptionGamificationEvent $event) {
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
