<?php

namespace App\Service\Mapper;

use App\Entity\Booking;
use App\Entity\Dto\BookingDtos\BookingDto;

class BookingMapper {

    public function toEntity(?BookingDto $bookingDto) : Booking {

        $booking = new Booking();
        $booking->setDateBooking($bookingDto->getDateBooking())
                ->setStatus($bookingDto->getStatus());
        return $booking;
    }

    public function toDto(?Booking $booking) : BookingDto {

        $bookingDto = new BookingDto();
        return $bookingDto;
    }
}