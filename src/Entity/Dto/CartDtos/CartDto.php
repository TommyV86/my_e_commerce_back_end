<?php

namespace App\Entity\Dto\CartDtos;

use App\Entity\Dto\BookingDtos\BookingDto;
use App\Entity\Dto\PersonDtos\PersonDto;
use App\Entity\Dto\ProductExemplaryDtos\ProductExemplaryDto;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

#[Groups("visible")]
class CartDto {
    
    private Collection $productExemplariesDto;

    #[SerializedName("_person")]
    private ?PersonDto $personDto = null;

    #[SerializedName("_booking")]
    private ?BookingDto $bookingDto = null;

    #[SerializedName("_totalSum")]
    private ?float $total_sum = null;

    public function __construct()
    {
        $this->productExemplariesDto = new ArrayCollection();
    }

    /**
     * @return Collection<int, ProductExemplaryDto>
     */
    public function getProductExemplariesDto(): Collection
    {
        return $this->productExemplariesDto;
    }

    /**
     * Set the value of productExemplariesDto
     *
     * @return  self
     */ 
    public function setProductExemplariesDto($productExemplariesDto) : self
    {
        $this->productExemplariesDto = $productExemplariesDto;

        return $this;
    }

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
    public function setPersonDto($personDto) : self
    {
        $this->personDto = $personDto;

        return $this;
    }

    /**
     * Get the value of booking
     */ 
    public function getBookingDto() : ?BookingDto
    {
        return $this->bookingDto;
    }

    /**
     * Set the value of booking
     *
     * @return  self
     */ 
    public function setBookingDto(?BookingDto $bookingDto) : self
    {
        $this->bookingDto = $bookingDto;

        return $this;
    }

    /**
     * Get the value of total_sum
     */ 
    public function getTotal_sum() : ?float
    {
        return $this->total_sum;
    }

    /**
     * Set the value of total_sum
     *
     * @return  self
     */ 
    public function setTotal_sum($total_sum) : static
    {
        $this->total_sum = $total_sum;

        return $this;
    }
}