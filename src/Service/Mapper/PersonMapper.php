<?php

namespace App\Service\Mapper;

use App\Entity\Dto\PersonDtos\PersonDto;
use App\Entity\Person;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class PersonMapper {

    private $addressMapper;
    private $commentMapper;
    private $bookingMapper;

    public function __construct(
        AddressMapper $addressMapper,
        CommentMapper $commentMapper,
        BookingMapper $bookingMapper)
    {
        $this->addressMapper = $addressMapper;
        $this->commentMapper = $commentMapper;
        $this->bookingMapper = $bookingMapper;
    }

    public function toEntity(PersonDto $personDto) : Person {

        $person = new Person();
        $address = $this->addressMapper->toEntity($personDto->getAddressDto());

        $person->setFirstname($personDto->getFirstname())
               ->setLastname($personDto->getLastname())
               ->setEmail($personDto->getEmail())
               ->setAddress($address)
               ->setComments($this->commentsToEntity($personDto->getCommentsDto()))
               ->setBookings($this->bookingsToEntity($personDto->getBookingsDto()));
        return $person;
    }

    public function toDto(Person $person) : PersonDto {

        $personDto = new PersonDto();
        $addressDto = $this->addressMapper->toDto($person->getAddress());

        $personDto->setFirstname($person->getFirstname())
                  ->setLastname($person->getLastname())
                  ->setEmail($person->getEmail())
                  ->setAddressDto($addressDto)
                  ->setCommentsDto($this->commentsToDto($person->getComments()))
                  ->setBookingsDto($this->bookingsToDto($person->getBookings()));
        return $personDto;
    }


    //mapper comment, booking collections functions 

    private function commentsToDto($comments) : ArrayCollection {

        $commentsDto = new ArrayCollection();
        foreach ($comments as $com) {
            $commentsDto->add($this->commentMapper->toDto($com));
        }

        return $comments;
    }

    private function commentsToEntity($commentsDto) : ArrayCollection {

        $comments = new ArrayCollection();
        foreach ($commentsDto as $comDto) {
            $comments->add($this->commentMapper->toEntity($comDto));
        }

        return $comments;
    }



    private function bookingsToDto($bookings) : ArrayCollection {

        $bookingsDto = new ArrayCollection();
        foreach ($bookings as $booking) {
            $bookingsDto->add($this->bookingMapper->toDto($booking));
        }

        return $bookingsDto;
    }

    private function bookingsToEntity($bookingsDto): ArrayCollection {

        $bookings = new ArrayCollection();
        foreach ($bookingsDto as $bookingDto) {
            $bookings->add($this->bookingMapper->toEntity($bookingDto));
        }

        return $bookings;
    }
}