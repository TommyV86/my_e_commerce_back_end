<?php

namespace App\Utility;

use App\Entity\Dto\PersonDtos\PersonDto;
use App\Entity\Person;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class CheckRole {

    public function isRoleUser(
        SerializerInterface $serializerInterface,
        EntityManagerInterface $entityManager,
        array $datas) : bool | Person
    {
        $personDto = $serializerInterface->deserialize(json_encode($datas['_person'] ), PersonDto::class, "json");
        $person = $entityManager->getRepository(Person::class)->findOneByEmail($personDto->getEmail());
        foreach ($person->getRoles() as $r) {
            if($r != 'ROLE_USER') return false;
        }
        return $person;
    }
}