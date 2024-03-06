<?php

namespace App\Service\EntityService;

use App\Entity\Person;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;

use App\Repository\PersonRepository;



class PersonService {

    private $serializer;
    private $userHashPassword;
    private $entityManager;


    public function __construct(
        SerializerInterface $serializer,
        UserPasswordHasherInterface $userHashPassword,
        EntityManagerInterface $entityManager
    ){
        $this->serializer = $serializer;
        $this->userHashPassword = $userHashPassword;
        $this->entityManager = $entityManager;
    }

    public function save(Request $request) : bool {

        if($request === null) return false;

        $data = $request->getContent();
        $person = $this->serializer->deserialize($data, Person::class, "json");

        $person->setPassword(
            $this->userHashPassword->hashPassword(
                $person,
                $person->getPassword()
            )
        );


        $this->entityManager->persist($person);
        $this->entityManager->flush();

        return true;
    }
}