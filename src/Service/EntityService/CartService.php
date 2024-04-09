<?php

namespace App\Service\EntityService;

use App\Entity\Cart;
use App\Entity\Dto\CartDtos\CartDto;
use App\Entity\Person;
use App\Service\Mapper\CartMapper;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\ORM\EntityManagerInterface;


class CartService {

    private SerializerInterface $serializer;
    private EntityManagerInterface $entityManager;
    private CartMapper $cartMapper;
    private CartDto $cartDto;
    private Cart $cart;
    private Person $person;
    private mixed $data;
    private array $roles;

    public function __construct(
        SerializerInterface $serializer,
        EntityManagerInterface $entityManager,
        CartMapper $cartMapper
    ){
        $this->serializer = $serializer;
        $this->entityManager = $entityManager;
        $this->cartMapper = $cartMapper;
    }

    public function save(Request $request) : bool {

        $this->data = $request->getContent();
        $this->cartDto = $this->serializer->deserialize($this->data, CartDto::class, "json");
        $this->cart = $this->cartMapper->toEntity($this->cartDto); 

        $this->person = $this->entityManager
                             ->getRepository(Person::class)
                             ->findOneByEmail($this->cart->getPerson()->getEmail());
        $this->roles = $this->person->getRoles();
        if($this->roles[0] != 'ROLE_USER') return false;

        $this->entityManager->persist($this->cart);
        $this->entityManager->flush();

        return true;
    }

}