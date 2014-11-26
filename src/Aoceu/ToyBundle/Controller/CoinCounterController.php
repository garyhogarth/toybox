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
    public function indexAction(Request $request)
    {
        $data = array('amount' => 0);

        $form = $this->createFormBuilder($data)
            ->add('amount', 'money',array('currency' => 'GBP'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $formData = $form->getData();

            $pennies = $formData['amount']*100;

            $coinCounts = $this->get('aoceu.toybox.coincounter')->lowestNumberOfCoins($pennies);

            return $this->render('@AoceuToy/CoinCounter/results.html.twig',array('amount' => $formData['amount'], 'coinCounts' => $coinCounts));
        }

        return array(
            'form' => $form->createView()
        );
    }

    /**
     * @Route("/{amount}", name="aoceu.toybox.coincounter.results")
     * @Template()
     */
    public function resultsAction($amount)
    {
        $coinCounts = $this->get('aoceu.toybox.coincounter')->lowestNumberOfCoins($amount);
        return array();
    }
}
