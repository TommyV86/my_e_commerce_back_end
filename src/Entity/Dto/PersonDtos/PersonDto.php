<?php

namespace App\Entity\Dto\PersonDtos;

use App\Entity\Dto\AddressDtos\AddressDto;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

#[Groups("visible")]
class PersonDto {

    #[SerializedName("_id")]
    private ?int $id = null;

    #[SerializedName("_lastname")]
    private ?string $lastname = null;

    #[SerializedName("_email")]
    private ?string $email = null;

    #[SerializedName("_address")]
    private ?AddressDto $addressDto = null;


    
    /**
     * Get the value of addressDto
     */ 
    public function getAddressDto() : ?AddressDto
    {
        return $this->addressDto;
    }

    /**
     * Set the value of addressDto
     *
     * @return  self
     */ 
    public function setAddressDto(?AddressDto $addressDto)
    {
        $this->addressDto = $addressDto;

        return $this;
    }


    /**
     * Get the value of id
     */ 
    public function getId() : ?int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId(?int $id) : self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of lastname
     */ 
    public function getLastname() : ?string
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */ 
    public function setLastname(?string $lastname) : self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail() : ?string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail(?string $email)
    {
        $this->email = $email;

        return $this;
    }
}