<?php

namespace Aoceu\ToyBundle\Services;

use Doctrine\ORM\EntityManager;

class CoinCounter
{

    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function lowestNumberOfCoins($amount)
    {
        $amount = $coinCounts = $this->parseInput($amount);

        // We could store the coins in a simple array however storing them in a DB gives us options in the future
        // e.g. multiple currencies, coin types etc.
        $coins = $this->em->getRepository('AoceuToyBundle:Coin')->getAllCoinsOrdered();

        $coinCounts = array();

        foreach ($coins as $coin) {
            // How many of this coin can we use
            $coinCount = floor($amount / $coin->getValue());

            $coinCounts[$coin->getName()] = (int) $coinCount;

            // If 1 or more of this coin type
            if ($coinCount > 0) {
                // Then update the running total
                $amount -= ($coinCount * $coin->getValue());
            }
        }

        return $coinCounts;
    }

    public function parseInput($input)
    {
        // Lets clean the input and convert to UTF-8 characters. It will make the parsing easier and account for dodgy server setups

        $inPounds = false;

        // There are only 2 allowable non numeric characters £ and p and the location of these are specific
        // Regex could achieve the same however for clarity and for future devs working on this code I have not


        if (preg_match('#^£#', $input) == 1) {
            $input = ltrim($input,'£');
            $inPounds = true;
        }
        
        if (substr($input,0,-1) == 'p') {
            $input = rtrim($input,'p');
            $inPounds = false;
        }

        // Check to see if we have to clean
        if (!is_numeric($input)) {
            return 0;
        }

        // Check to see if we have to clean number or float (or partial e.g. 2.)
//        if (is_numeric( $input ) && floor( $input ) != $input) {
//            echo "float";
//        }

        if (is_numeric($input) && $inPounds) {
            $input = $input*100;
        }


        return $input;
    }
}
