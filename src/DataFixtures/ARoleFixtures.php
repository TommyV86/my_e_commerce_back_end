<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use App\Entity\Role;

class ARoleFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
        $adminRole = new Role();
        $adminRole->setType('ROLE_ADMIN');

        $manager->persist($adminRole);
        $manager->flush();
        
        echo '*** role admin persisted ***';
    }

    public static function getGroups(): array
    {
        return ['groupRole'];
    }
}
