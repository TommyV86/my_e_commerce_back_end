<?php

namespace App\Entity\Dto\AddressDtos;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

#[Groups("visible")]
class AddressDto {

    #[SerializedName("_id")]
    private ?int $id = null;

    #[SerializedName("_street")]
    private ?string $street = null;

    #[SerializedName("_number")]
    private ?int $number = null;

    #[SerializedName("_town")]
    private ?string $town = null;

    

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
    public function setId(?int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of street
     */ 
    public function getStreet() : ?string
    {
        return $this->street;
    }

    /**
     * Set the value of street
     *
     * @return  self
     */ 
    public function setStreet(?string $street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get the value of number
     */ 
    public function getNumber() : ?int
    {
        return $this->number;
    }

    /**
     * Set the value of number
     *
     * @return  self
     */ 
    public function setNumber(?int $number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get the value of town
     */ 
    public function getTown() : ?string
    {
        return $this->town;
    }

    /**
     * Set the value of town
     *
     * @return  self
     */ 
    public function setTown(?string $town)
    {
        $this->town = $town;

        return $this;
    }
}