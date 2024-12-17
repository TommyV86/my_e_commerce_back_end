<?php

namespace App\Entity\Dto\BookingDtos;

use App\Entity\Dto\CartDtos\CartDto;
use App\Entity\Dto\PersonDtos\PersonDto;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

#[Groups("visible")]
class BookingDto {

    #[SerializedName("_id")]
    private ?int $id = null;

    #[SerializedName("_status")]
    private ?bool $status = null;

    #[SerializedName("_dateBooking")]
    private ?\DateTimeInterface $dateBooking = null;

    #[SerializedName("_person")]
    private ?PersonDto $personDto = null;

    #[SerializedName("_cart")]
    private ?CartDto $cartDto = null;


    /**
     * Get the value of personDto
     */ 
    public function getPersonDto() : ?PersonDto
    {
        return $this->personDto;
    }

    /**
     * Set the value of personDto
     *
     * @return  self
     */ 
    public function setPersonDto(?PersonDto $personDto) : self
    {
        $this->personDto = $personDto;

        return $this;
    }

    /**
     * Get the value of cartDto
     */ 
    public function getCartDto() : ?CartDto
    {
        return $this->cartDto;
    }

    /**
     * Set the value of cartDto
     *
     * @return  self
     */ 
    public function setCartDto(?CartDto $cartDto) : self
    {
        $this->cartDto = $cartDto;

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
     * Get the value of status
     */ 
    public function getStatus() : ?bool
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus(?bool $status) : self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of date_booking
     */ 
    public function getDateBooking() : ?\DateTimeInterface
    {
        return $this->dateBooking;
    }

    /**
     * Set the value of date_booking
     *
     * @return  self
     */ 
    public function setDateBooking(?\DateTimeInterface $dateBooking) : self
    {
        $this->dateBooking = $dateBooking;

        return $this;
    }
}