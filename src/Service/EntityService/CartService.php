<?php

namespace App\Service\EntityService;

use App\Entity\Cart;
use App\Entity\Dto\CartDtos\CartDto;
use App\Entity\Dto\PersonDtos\PersonDto;
use App\Entity\Person;
use App\Service\Mapper\CartMapper;
use App\Service\Mapper\PersonMapper;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\ORM\EntityManagerInterface;


class CartService {

    private SerializerInterface $serializer;
    private EntityManagerInterface $entityManager;
    private CartMapper $cartMapper;
    private PersonMapper $personMapper;
    private CartDto $cartDto;
    private Cart $cart;
    private PersonDto $personDto;
    private Person $person;
    private mixed $data;
    private array $dataArray;
    private float $sum;

    public function __construct(
        SerializerInterface $serializer,
        EntityManagerInterface $entityManager,
        CartMapper $cartMapper,
        PersonMapper $personMapper

    ){
        $this->serializer = $serializer;
        $this->entityManager = $entityManager;
        $this->cartMapper = $cartMapper;
        $this->personMapper = $personMapper;
    }

    public function save(Request $request) : mixed {

        $this->data = $request->getContent();
        $this->dataArray = json_decode($this->data, true);
        $this->sum = $this->dataArray['_totalSum'];
        
        //verification du role
        $this->personDto = $this->serializer->deserialize(json_encode($this->dataArray['_person'] ), PersonDto::class, "json");        
        $this->person = $this->entityManager->getRepository(Person::class)->findOneByEmail($this->personDto->getEmail());
        foreach ($this->person->getRoles() as $r) {
            if($r != 'ROLE_USER') return false;
        }
        
        $this->cartDto = $this->serializer->deserialize($this->data, CartDto::class, "json");
        $this->cart = $this->cartMapper->toEntity($this->cartDto); 

        $this->cart->setPerson($this->person)
                   ->setTotalSum($this->sum);

        $this->entityManager->persist($this->cart);
        $this->entityManager->flush();

        return $this->data;
    }

}