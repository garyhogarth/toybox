<?php

namespace Aoceu\ToyBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class MainController
 * @package Aoceu\ToyBundle\Controller
 * @Route("/")
 */
class MainController extends Controller
{
    /**
     * @Route("/", name="aoceu.toybox.home")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
}
