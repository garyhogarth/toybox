<?php

namespace Aoceu\ToyBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Aoceu\ToyBundle\Entity\Coin;

class LoadToyData implements FixtureInterface {

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $coin = new Coin();
        $coin->setName('£2');
        $coin->setValue('200');
        $manager->persist($coin);

        $coin = new Coin();
        $coin->setName('£1');
        $coin->setValue('100');
        $manager->persist($coin);

        $coin = new Coin();
        $coin->setName('50p');
        $coin->setValue('50');
        $manager->persist($coin);

        $coin = new Coin();
        $coin->setName('20p');
        $coin->setValue('20');
        $manager->persist($coin);

        $coin = new Coin();
        $coin->setName('10p');
        $coin->setValue('10');
        $manager->persist($coin);

        $coin = new Coin();
        $coin->setName('5p');
        $coin->setValue('5');
        $manager->persist($coin);

        $coin = new Coin();
        $coin->setName('2p');
        $coin->setValue('2');
        $manager->persist($coin);

        $coin = new Coin();
        $coin->setName('1p');
        $coin->setValue('1');
        $manager->persist($coin);

        $manager->flush();
    }
} 