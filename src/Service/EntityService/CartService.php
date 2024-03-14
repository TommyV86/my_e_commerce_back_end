<?php

namespace App\Service\EntityService;

use App\Entity\Cart;
use App\Entity\Person;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\ORM\EntityManagerInterface;


class CartService {

    private SerializerInterface $serializer;
    private EntityManagerInterface $entityManager;

    public function __construct(
        SerializerInterface $serializer,
        EntityManagerInterface $entityManager
    ){
        $this->serializer = $serializer;
        $this->entityManager = $entityManager;
    }

    public function save(Request $request) : bool {

        $data = $request->getContent();
        $cart = $this->serializer->deserialize($data, Cart::class, "json");

        $attribute_from_data = json_decode($request->getContent(), true);
        $email = (string) $attribute_from_data['email'];
        echo ' *** email *** : '.$email;

        $person = $this->entityManager->getRepository(Person::class)->findOneByEmail($email);

        $roles = $person->getRoles();

        if($roles[0] != 'ROLE_USER') return false;

        $cart->setPerson($person);
        $this->entityManager->persist($cart);
        $this->entityManager->flush();

        return true;
    }

}