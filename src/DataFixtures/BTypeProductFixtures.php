<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use App\Entity\TypeProduct;

class BTypeProductFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
        $typeProductOne = new TypeProduct();
        $typeProductTwo = new TypeProduct();
        $typeProductThree = new TypeProduct();

        $typeProductOne->setName('fruit');
        $typeProductTwo->setName('légume');
        $typeProductThree->setName('viande');

        $manager->persist($typeProductOne);
        $manager->persist($typeProductTwo);
        $manager->persist($typeProductThree);

        $manager->flush();

        echo '*** type products persisted ***';
    }

    public static function getGroups(): array
    {
        return ['groupTypeProd'];
    }
}
