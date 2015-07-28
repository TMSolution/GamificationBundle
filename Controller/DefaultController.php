<?php

namespace TMSolution\GamificationBundle\Controller;

use Core\BaseBundle\Controller\DefaultController as BaseController;
//use TMSolution\BaseBundle\Model\Model;
use Core\BaseBundle\Model\Model;


class DefaultController extends BaseController
{
    public function checkAction($objectIdentity, $classId)
    {
        $model = $this->getModel('TMSolution\GamificationBundle\Entity\Objectinstance');
      
        $model->getInstance($objectIdentity, $classId);
        
    }
}


//dwie metody, check i create w modelu
//check - musi sprawdzac czy obiekt istnieje w objectinstance, zwrotka true false jesli istnieje
//create - wykorzystuje check do sprawdzenia czy klasa istnieje, jak nie istnieje to eby wytwarzala obiekt nowy