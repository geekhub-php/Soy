<?php

namespace Soy\Bundle\SoyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('SoyBundle:Default:index.html.twig', array('name' => $name));
    }
}
