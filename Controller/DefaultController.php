<?php

namespace TMSolution\GamificationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('TMSolutionGamificationBundle:Default:index.html.twig', array('name' => $name));
    }
}
