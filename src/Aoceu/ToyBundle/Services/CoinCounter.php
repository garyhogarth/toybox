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
}
