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


use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class TestEventListener {

//    public function onKernelException(GetResponseForExceptionEvent $event) {
//        // You get the exception object from the received event
//        $exception = $event->getException();
//        $message = sprintf(
//                'My Error says: %s with code: %s', $exception->getMessage(), $exception->getCode()
//        );
//
//        // Customize your response object to display the exception details
//        $response = new Response();
//        $response->setContent($message);
//
//        // HttpExceptionInterface is a special type of exception that
//        // holds status code and header details
//        if ($exception instanceof HttpExceptionInterface) {
//            $response->setStatusCode($exception->getStatusCode());
//            $response->headers->replace($exception->getHeaders());
//        } else {
//            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
//        }
//
//        // Send the modified response object to the event
//        $event->setResponse($response);
//    }

    public function onKernelResponse(FilterResponseEvent $event) {
        $response = $event->getResponse();
        
        // ... modify the response object
    }

}
