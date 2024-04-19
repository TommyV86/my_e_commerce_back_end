<?php

namespace App\Service\EntityService;

use App\Entity\Cart;
use App\Entity\Dto\CartDtos\CartDto;
use App\Entity\Person;
use App\Service\Mapper\CartMapper;
use App\Service\Mapper\PersonMapper;
use App\Utility\CheckRole;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\ORM\EntityManagerInterface;


class CartService {

    private SerializerInterface $serializer;
    private EntityManagerInterface $entityManager;
    private CheckRole $checkRole;

    private CartMapper $cartMapper;
    private CartDto $cartDto;
    private Cart $cart;
    private Person $person;
    private mixed $data;
    private array $dataArray;
    private float $sum;

    public function __construct(
        SerializerInterface $serializer,
        EntityManagerInterface $entityManager,
        CartMapper $cartMapper,
        PersonMapper $personMapper,
        CheckRole $checkRole

    ){
        $this->serializer = $serializer;
        $this->entityManager = $entityManager;
        $this->cartMapper = $cartMapper;
        $this->checkRole = $checkRole;
    }

    public function save(Request $request) : mixed {

        $this->data = $request->getContent();
        $this->dataArray = json_decode($this->data, true);
        $this->sum = $this->dataArray['_totalSum'];
        
        if(!$this->checkRole->isRoleUser($this->serializer, $this->entityManager, $this->dataArray)){ 
            return false;
        } else {
            $this->person = $this->checkRole->isRoleUser($this->serializer, $this->entityManager, $this->dataArray);
        };

        
        $this->cartDto = $this->serializer->deserialize($this->data, CartDto::class, "json");
        $this->cart = $this->cartMapper->toEntity($this->cartDto); 

        $this->cart->setPerson($this->person)
                   ->setTotalSum($this->sum);

        $this->entityManager->persist($this->cart);
        $this->entityManager->flush();

        return $this->data;
    }

}