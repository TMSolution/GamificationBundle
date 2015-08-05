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



class GamificationResponseListener {

    //put your code here

    public function onKernelResponse(FilterResponseEvent $event) {

       \Doctrine\Common\Util\Debug::dump( $event);
        echo "jestem listenerem";
    }

    public function afterKernelResponse(FilterResponseEvent $event) {

        echo "jestem listenerem po evencie";
    }

//    public function onKernelController(FilterControllerEvent $event) {
//        // ...
//
//        if ($controller[0] instanceof TokenAuthenticatedController) {
//            $token = $event->getRequest()->query->get('token');
//            if (!in_array($token, $this->tokens)) {
//                throw new AccessDeniedHttpException('This action needs a valid token!');
//            }
//
//            // mark the request as having passed token authentication
//            $event->getRequest()->attributes->set('auth_token', $token);
//        }
//    }

//    public function onKernelResponse(FilterResponseEvent $event) {
//        // check to see if onKernelController marked this as a token "auth'ed" request
//        if (!$token = $event->getRequest()->attributes->get('auth_token')) {
//            return;
//        }
//
//        $response = $event->getResponse();
//
//        // create a hash and set it as a response header
//        $hash = sha1($response->getContent() . $token);
//        $response->headers->set('X-CONTENT-HASH', $hash);
//    }

}
