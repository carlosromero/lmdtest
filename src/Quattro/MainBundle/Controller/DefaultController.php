<?php

namespace Quattro\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('QuattroMainBundle:Default:index.html.twig');
    }
}
