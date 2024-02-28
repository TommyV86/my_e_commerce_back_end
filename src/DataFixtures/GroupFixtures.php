<?php

namespace App\DataFixtures;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class GroupFixtures implements DependentFixtureInterface
{

    public function getDependencies()
    {
        return [
            CProductFixtures::class,
            BTypeProductFixtures::class,
            ARoleFixtures::class
        ];
    }
}
