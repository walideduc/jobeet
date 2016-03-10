<?php

namespace Alyya\JobeetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AlyyaJobeetBundle:Default:index.html.twig');
    }
}
