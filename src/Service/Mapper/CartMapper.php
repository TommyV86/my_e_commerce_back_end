<?php

namespace App\Service\Mapper;

use App\Entity\Cart;
use App\Entity\Dto\CartDtos\CartDto;
use Doctrine\Common\Collections\ArrayCollection;

class CartMapper {

    private $productExemplaryMapper;
    private $personMapper;
    private $bookingMapper;

    public function __construct(
        ProductExemplaryMapper $productExemplaryMapper,
        PersonMapper $personMapper,
        BookingMapper $bookingMapper
    )
    {
        $this->productExemplaryMapper = $productExemplaryMapper;    
        $this->personMapper = $personMapper;
        $this->bookingMapper= $bookingMapper;    
    }

    public function toEntity(CartDto $cartDto) : Cart {

        $cart = new Cart();
        $cart->setTotalSum($cartDto->getTotal_sum())
             ->setPerson($this->personMapper->toEntity($cartDto->getPersonDto()))
             ->setBooking($this->bookingMapper->toEntity($cartDto->getBookingDto()))
             ->setProductExemplaries($this->productExemplariesToEntity($cartDto->getProductExemplariesDto()));
        
        return $cart;
    }

    public function toDto(Cart $cart) : CartDto {

        $cartDto = new CartDto();
        $cartDto->setTotal_sum($cart->getTotalSum())
                ->setPersonDto($this->personMapper->toDto($cart->getPerson()))
                ->setBookingDto($this->bookingMapper->toDto($cart->getBooking()))
                ->setProductExemplariesDto($this->productExemplariesToDto($cart->getProductExemplaries()));

        return $cartDto;
    }

    //mapper productEx collection functions

    private function productExemplariesToEntity($productExemplariesDto) : ArrayCollection {

        $productExemplaries = new ArrayCollection();
        foreach ($productExemplariesDto as $pExsDto) {
            $productExemplaries->add($this->productExemplaryMapper->toEntity($pExsDto));
        }

        return $productExemplaries;
    }

    private function productExemplariesToDto($productExemplaries) : ArrayCollection {

        $productExemplariesDto = new ArrayCollection();
        foreach ($productExemplaries as $pExs) {
            $productExemplariesDto->add($this->productExemplaryMapper->toDto($pExs));
        }

        return $productExemplariesDto;
    }
}