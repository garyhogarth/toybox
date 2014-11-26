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

    public function testNumberParser()
    {
        $testResults = array(
            '4' => 4,
            '85' => 85,
            '197p' => 197,
            '2p' => 2,
            '1.87' => 187,
            '£1.23' => 123,
            '£2' => 200,
            '£10' => 1000,
            '£1.87p' => 187,
            '£1p' => 100,
            '£1.p' => 100,
            '001.41p'  => 141,
            '4.235' => 424,
            '£1.257422457' =>126,
            '' => 0,
            '1x' => 0,
            '£1x.0p' => 0,
            '£p' => 0
        );


        foreach($testResults as $amount => $expectedResult) {
            $this->assertEquals($expectedResult, $this->container->get('aoceu.toybox.coincounter')->parseInput($amount));
        }
    }

    public function testCounterService()
    {
        // Based on array keys '£2','£1','50p','20p','10p','5p','2p','1p'
        $testResults = array(
            '4' => array(0, 0, 0, 0, 0, 0, 2, 0),
            '85' => array(0, 0, 1, 1, 1, 1, 0, 0),
            '197p' => array(0, 1, 1, 2, 0, 1, 1, 0),
            '2p' => array(0, 0, 0, 0, 0, 0, 1, 0),
            '1.87' => array(0, 1, 1, 1, 1, 1, 1, 0),
            '£1.23' => array(0, 1, 0, 1, 0, 0, 1, 1),
            '£2' => array(1, 0, 0, 0, 0, 0, 0, 0),
            '£10' => array(5, 0, 0, 0, 0, 0, 0, 0),
            '£1.87p' => array(0, 1, 1, 1, 1, 1, 1, 0),
            '£1p' => array(0, 1, 0, 0, 0, 0, 0, 0),
            '£1.p' => array(0, 1, 0, 0, 0, 0, 0, 0),
            '001.41p'  => array(0, 1, 0, 2, 0, 0, 0, 1),
            '4.235' => array(2, 0, 0, 1, 0, 0, 2, 0),
            '£1.257422457' =>array(0, 1, 0, 1, 0, 1, 0, 1),
            '' => array(0, 0, 0, 0, 0, 0, 0, 0),
            '1x' => array(0, 0, 0, 0, 0, 0, 0, 0),
            '£1x.0p' => array(0, 0, 0, 0, 0, 0, 0, 0),
            '£p' => array(0, 0, 0, 0, 0, 0, 0, 0)
        );

        foreach($testResults as $amount => $expectedResult) {
            $this->assertEquals($expectedResult, array_values($this->container->get('aoceu.toybox.coincounter')->lowestNumberOfCoins($amount)));
        }
    }
}
