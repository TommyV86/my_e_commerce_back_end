<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Person;
use Doctrine\Common\Collections\ArrayCollection;

use Faker;

class DPersonFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        $persons = new ArrayCollection();

        for ($i=0; $i < 5 ; $i++) { 
            $persons->add(new Person());
            $persons->get($i)->setLastname($faker->lastName)
                             ->setFirstname($faker->firstName)
                             ->setEmail($faker->email)
                             ->setPassword($faker->password(6));
        }

        foreach ($persons as $person) {
            $manager->persist($person);
        }

        $manager->flush();
    }
}
