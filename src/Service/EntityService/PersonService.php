<?php

namespace App\Service\EntityService;

use App\Entity\Dto\PersonDtos\PersonDto;
use App\Entity\Person;
use App\Service\Mapper\PersonMapper;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;


class PersonService {

    private SerializerInterface $serializer;
    private PersonMapper $personMapper;
    private UserPasswordHasherInterface $userHashPassword;
    private EntityManagerInterface $entityManager;


    public function __construct(
        SerializerInterface $serializer,
        PersonMapper $personMapper,
        UserPasswordHasherInterface $userHashPassword,
        EntityManagerInterface $entityManager
    ){
        $this->serializer = $serializer;
        $this->personMapper = $personMapper;
        $this->userHashPassword = $userHashPassword;
        $this->entityManager = $entityManager;
    }

    public function save(Request $request) : bool {

        if($request === null) return false;

        $data = $request->getContent();
        $personDto = $this->serializer->deserialize($data, PersonDto::class, 'json');
        $person = $this->personMapper->toEntity($personDto);

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