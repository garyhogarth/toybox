<?php

namespace Aoceu\ToyBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CoinCounterController
 * @package Aoceu\ToyBundle\Controller
 * @Route("/toys/coin-counter")
 */
class CoinCounterController extends Controller
{
    /**
     * @Route("/", name="aoceu.toybox.coincounter.index")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
}
