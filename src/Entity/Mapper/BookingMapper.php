<?php

namespace App\Entity\Mapper;

use App\Entity\Booking;
use App\Entity\Dto\BookingDtos\BookingDto;

class BookingMapper {

    //injecter cart et person mapper
    private $cartMapper;
    private $personMapper;

    public function __construct(
        CartMapper $cartMapper,
        PersonMapper $personMapper
    )
    {
        $this->cartMapper = $cartMapper;    
        $this->personMapper = $personMapper;
    }

    public function toEntity(BookingDto $bookingDto) : Booking {

        $booking = new Booking();
        $booking->setPerson($bookingDto->getPersonDto())
                ->setStatus($bookingDto->getStatus())
                ->setCart($this->cartMapper->toEntity($bookingDto->getCartDto()))
                ->setPerson($this->personMapper->toEntity($bookingDto->getPersonDto()));
        return $booking;
    }

    public function toDto(Booking $booking) : BookingDto {

        $bookingDto = new BookingDto();
        $bookingDto->setPersonDto($booking->getPerson())
                   ->setStatus($booking->isStatus())
                   ->setCartDto($this->cartMapper->toDto($booking->getCart()))
                   ->setPersonDto($this->personMapper->toDto($booking->getPerson()));
        return $bookingDto;
    }
}