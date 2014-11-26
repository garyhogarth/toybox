<?php

namespace Aoceu\ToyBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CoinCounterTest extends WebTestCase
{
    private $container;

    public function setUp()
    {
        self::bootKernel();
        $this->container = static::$kernel->getContainer();
    }

    public function testCounterService()
    {


        // Based on array keys '£2','£1','50p','20p','10p','5p','2p','1p'
        $testResults = array(
            142 => array(0, 1, 0, 2, 0, 0, 1, 0),
            67 => array(0, 0, 1, 0, 1, 1, 1, 0),
            532 => array(2, 1, 0, 1, 1, 0, 1, 0),
            4 => array(0, 0, 0, 0, 0, 0, 2, 0),
            3 => array(0, 0, 0, 0, 0, 0, 1, 1)
        );

        foreach($testResults as $amount => $expectedResult) {
            $this->assertEquals($expectedResult, array_values($this->container->get('aoceu.toybox.coincounter')->lowestNumberOfCoins($amount)));
        }
    }
}
