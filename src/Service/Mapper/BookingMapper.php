<?php

namespace App\Service\Mapper;

use App\Entity\Booking;
use App\Entity\Dto\BookingDtos\BookingDto;

class BookingMapper {

    public function toEntity(BookingDto $bookingDto) : Booking {

        $booking = new Booking();
        $booking->setPerson($bookingDto->getPersonDto())
                ->setStatus($bookingDto->getStatus())
                ->setCart($bookingDto->getCartDto())
                ->setPerson($bookingDto->getPersonDto());
        return $booking;
    }

    public function toDto(Booking $booking) : BookingDto {

        $bookingDto = new BookingDto();
        $bookingDto->setPersonDto($booking->getPerson())
                   ->setStatus($booking->isStatus())
                   ->setCartDto($booking->getCart())
                   ->setPersonDto($booking->getPerson());
        return $bookingDto;
    }
}