<?php

namespace App\Entity\Dto\ProductDtos;

use App\Entity\Dto\ProductExemplaryDtos\ProductExemplaryDto;
use App\Entity\Dto\TypeProductDtos\TypeProductDto;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

#[Groups("visible")]
class ProductDto {

    #[SerializedName("_name")]
    private ?string $name = null;

    #[SerializedName("_description")]
    private ?string $description = null;

    #[SerializedName("_price")]
    private ?float $price = null;

    #[SerializedName("_productExemplaries")]
    private Collection $productExemplariesDto;

    #[SerializedName("_typeProduct")]
    private ?TypeProductDto $typeProductDto = null;


    public function __construct()
    {
        $this->productExemplariesDto = new ArrayCollection();
    }


    /**
     * @return Collection<int, ProductExemplary>
     */
    public function getProductExemplariesDto(): Collection
    {
        return $this->productExemplariesDto;
    }

    public function addProductExemplaryDto(ProductExemplaryDto $productExemplaryDto): static
    {
        if (!$this->productExemplariesDto->contains($productExemplaryDto)) {
            $this->productExemplariesDto->add($productExemplaryDto);
            $productExemplaryDto->setProductDto($this);
        }

        return $this;
    }

    public function removeproductExemplaryDto(ProductExemplaryDto $productExemplaryDto): static
    {
        if ($this->productExemplariesDto->removeElement($productExemplaryDto)) {
            // set the owning side to null (unless already changed)
            if ($productExemplaryDto->getProductDto() === $this) {
                $productExemplaryDto->setProductDto(null);
            }
        }

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName() : ?string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName(?string $name) : self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription() : ?string
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription(?string $description) : self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice() : ?float
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice(?float $price) : self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of typeProductDto
     */ 
    public function getTypeProductDto() : ?TypeProductDto
    {
        return $this->typeProductDto;
    }

    /**
     * Set the value of typeProductDto
     *
     * @return  self
     */ 
    public function setTypeProductDto(?TypeProductDto $typeProductDto) : self
    {
        $this->typeProductDto = $typeProductDto;

        return $this;
    }
}