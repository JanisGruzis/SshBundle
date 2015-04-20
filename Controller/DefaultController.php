<?php

namespace JanisGruzis\SshBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('JanisGruzisSshBundle:Default:index.html.twig', array('name' => $name));
    }
}
