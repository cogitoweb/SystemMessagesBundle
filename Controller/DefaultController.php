<?php

namespace Cogitoweb\SystemMessagesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('CogitowebSystemMessagesBundle:Default:index.html.twig', array('name' => $name));
    }
}
