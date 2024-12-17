<?php

namespace App\Service\EntityService;

use App\Entity\Booking;
use App\Entity\Cart;
use App\Entity\Dto\BookingDtos\BookingDto;
use App\Service\Mapper\BookingMapper;
use App\Entity\Person;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\ORM\EntityManagerInterface;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;

class BookingService {

    private SerializerInterface $serializer;
    private BookingMapper $bookingMapper;
    private EntityManagerInterface $entityManager;

    public function __construct(
        SerializerInterface $serializer,
        BookingMapper $bookingMapper,
        EntityManagerInterface $entityManager,

    ){
        $this->serializer = $serializer;
        $this->bookingMapper = $bookingMapper;
        $this->entityManager = $entityManager;
    }

    public function save(Request $request) : bool {
        
        $data = $request->getContent();
        $bookingDto = $this->serializer->deserialize($data, BookingDto::class, 'json');
        $booking = $this->bookingMapper->toEntity($bookingDto); 

        $datasIntoArray = json_decode($data, true);
        $email = (string) $datasIntoArray['username'];
        $idCart = (int) $datasIntoArray['idCart'];
        $person = $this->entityManager->getRepository(Person::class)->findOneByEmail($email);
        $cart = $this->entityManager->getRepository(Cart::class)->find($idCart);

        if($request && $person === null) return false;

        $booking->setPerson($person)
                ->setCart($cart)
                ->setDateBooking(new DateTime('now'))
                ->setStatus(false);
        
        $this->entityManager->persist($booking);
        $this->entityManager->flush();

        return true;
    }

    public function getAllByIdClient(int $id) : ArrayCollection {

        //creer une query findbyidclient
        $bookings = $this->entityManager->getRepository(Booking::class)->findAllByIdClient($id);

        $bookingsDto = new ArrayCollection();
        foreach ($bookings as $b) {
            $bookingsDto->add($this->bookingMapper->toDto($b));
        }
        return $bookingsDto;
    }

}