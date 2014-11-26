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
            ->add('amount', 'text',array('attr' => array("autocomplete" => "off")))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $formData = $form->getData();

            $coinCounts = $this->get('aoceu.toybox.coincounter')->lowestNumberOfCoins($formData['amount']);

            $viewData = array('amount' => $this->get('aoceu.toybox.coincounter')->parseInput($formData['amount'])/100, 'coinCounts' => $coinCounts);

            if ($request->isXmlHttpRequest()) {
                $template = 'results.content.html.twig';
            } else {
                $template = 'results.html.twig';
            }

            return $this->render('@AoceuToy/CoinCounter/'.$template,$viewData);
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
