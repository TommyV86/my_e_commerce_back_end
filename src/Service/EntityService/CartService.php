<?php

namespace App\Service\EntityService;

use App\Entity\Booking;
use App\Entity\Cart;
use App\Entity\Dto\BookingDtos\BookingDto;
use App\Entity\Dto\CartDtos\CartDto;
use App\Entity\Person;
use App\Service\Mapper\CartMapper;
use App\Service\Mapper\PersonMapper;
use App\Utility\CheckRole;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\ORM\EntityManagerInterface;
use DateTime;

class CartService {

    private SerializerInterface $serializer;
    private EntityManagerInterface $entityManager;
    private CheckRole $checkRole;

    private CartMapper $cartMapper;
    private PersonMapper $personMapper;

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
        $this->personMapper = $personMapper;
    }

    public function save(Request $request) : mixed {

        $this->data = $request->getContent();
        $this->dataArray = json_decode($this->data, true);
        $this->sum = $this->dataArray['totalSum'];
        
        if(!$this->checkRole->isRoleUser($this->serializer, $this->entityManager, $this->dataArray)){ 
            return false;
        } else {
            $this->person = $this->checkRole->isRoleUser($this->serializer, $this->entityManager, $this->dataArray);
        };

        
        $this->cartDto = $this->serializer->deserialize($this->data, CartDto::class, "json");
        $this->cartDto->setBookingDto(new BookingDto());
        $this->cartDto->getBookingDto()->setDateBooking(new DateTime('now'))
                                       ->setStatus(false)
                                       ->setPersonDto($this->personMapper->toDto($this->person));
                                       

        $this->cart = $this->cartMapper->toEntity($this->cartDto); 

        $this->cart->setPerson($this->person)
                   ->setTotalSum($this->sum);

        $booking = new Booking();
        $booking->setDateBooking(new DateTime('now'))
                ->setPerson($this->person)
                ->setStatus(false);

        $this->cart->setBooking($booking);
        
        $this->entityManager->persist($this->cart);
        $this->entityManager->flush();

        return $this->data;
    }

    public function findAllByidClient(Request $request) : ArrayCollection {

        //todo
        //retrouver les dates via l'id de person avec le service de booking

        $id = $request->query->getInt("id");
        $carts = $this->entityManager->getRepository(Cart::class)->findAllByidClient($id);

        $cartDtos = new ArrayCollection();
        foreach ($carts as $c) {
            $cartDtos->add($this->cartMapper->toDto($c));
        }

        return $cartDtos;
    }

}