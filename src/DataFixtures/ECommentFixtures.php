<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Comment;
use App\Entity\Person;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Faker;


class ECommentFixtures extends Fixture
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function load(ObjectManager $manager): void
    {        
        $faker = Faker\Factory::create();

        $indexPerson = 0;
        $comments = new ArrayCollection();
        $persons = new ArrayCollection(
            $this->entityManager->getRepository(Person::class)
                                ->findAll());
        
        for ($i=0; $i < 5; $i++){ 
            $comments->add(new Comment());
        }

        //ajouter à chaque commentaire un user fictif
        foreach ($comments as $comment) {
            $comment->setPerson($persons->get($indexPerson));
            $comment->setText("ceci est le commentaire numero : " .$indexPerson);
            $manager->persist($comment);
            $indexPerson++;
        }

        $manager->flush();
        echo "*** comments users persisted ***";
    }
}
