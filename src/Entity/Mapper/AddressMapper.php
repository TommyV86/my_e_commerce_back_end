<?php

namespace App\Entity\Mapper;

use App\Entity\Address;
use App\Entity\Dto\AddressDtos\AddressDto;

class AddressMapper {

    public function toEntity(AddressDto $addressDto) : Address {

        $address = new Address();
        $address->setStreet($addressDto->getStreet())
                ->setNumber($addressDto->getNumber())
                ->setTown($address->getTown());

        return $address;
    }

    public function toDto(Address $address) : AddressDto {

        $addressDto = new AddressDto();
        $addressDto->setStreet($address->getStreet())
                   ->setNumber($address->getNumber())
                   ->setTown($address->getTown());

        return $addressDto;
    }
}