<?php

namespace App\Entity\Dto\ProductExemplaryDtos;

use App\Entity\Dto\CartDtos\CartDto;
use App\Entity\Dto\ProductDtos\ProductDto;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

#[Groups("visible")]
class ProductExemplaryDto {

    #[SerializedName("_quantity")]
    private ?int $quantity = null;

    #[SerializedName("_imageName")]
    private ?string $imageName = null;

    #[SerializedName("_cart")]
    private ?CartDto $cartDto = null;

    #[SerializedName("_product")]
    private ?ProductDto $productDto = null;


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
     * Get the value of productDto
     */ 
    public function getProductDto() : ?ProductDto
    {
        return $this->productDto;
    }

    /**
     * Set the value of productDto
     *
     * @return  self
     */ 
    public function setProductDto(?ProductDto $productDto) : self
    {
        $this->productDto = $productDto;

        return $this;
    }

    /**
     * Get the value of quantity
     */ 
    public function getQuantity() : ?int
    {
        return $this->quantity;
    }

    /**
     * Set the value of quantity
     *
     * @return  self
     */ 
    public function setQuantity(?int $quantity) : self
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get the value of imageName
     */ 
    public function getImageName() : ?string
    {
        return $this->imageName;
    }

    /**
     * Set the value of imageName
     *
     * @return  self
     */ 
    public function setImageName(?string $imageName) : self
    {
        $this->imageName = $imageName;

        return $this;
    }
}