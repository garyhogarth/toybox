<?php

namespace Aoceu\ToyBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Aoceu\ToyBundle\Entity\Coin;

/**
 * CoinRepository
 */
class CoinRepository extends EntityRepository
{
    public function getAllCoinsOrdered($order = 'DESC')
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT c FROM AoceuToyBundle:Coin c ORDER BY c.value " . $order);

        $result = $query->getResult();

        return $result;

    }
}
