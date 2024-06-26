<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $name = null;

    #[ORM\OneToMany(targetEntity: ProductExemplary::class, mappedBy: 'product')]
    private Collection $productExemplaries;

    #[ORM\Column(length: 700, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    private ?TypeProduct $typeProduct = null;

    #[ORM\Column(nullable: true)]
    private ?float $price = null;

    private ?int $quantity = null;

    public function __construct()
    {
        $this->productExemplaries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, ProductExemplary>
     */
    public function getProductExemplaries(): Collection
    {
        return $this->productExemplaries;
    }

    
    /**
     * Set the value of productExemplaries
     *
     * @return  self
     */ 
    public function setProductExemplaries($productExemplaries)
    {
        $this->productExemplaries = $productExemplaries;

        return $this;
    }
    
    public function addProductExemplary(ProductExemplary $productExemplary): static
    {
        if (!$this->productExemplaries->contains($productExemplary)) {
            $this->productExemplaries->add($productExemplary);
            $productExemplary->setProduct($this);
        }

        return $this;
    }

    public function removeProductExemplary(ProductExemplary $productExemplary): static
    {
        if ($this->productExemplaries->removeElement($productExemplary)) {
            // set the owning side to null (unless already changed)
            if ($productExemplary->getProduct() === $this) {
                $productExemplary->setProduct(null);
            }
        }

        return $this;
    }


    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getTypeProduct(): ?TypeProduct
    {
        return $this->typeProduct;
    }

    public function setTypeProduct(?TypeProduct $typeProduct): static
    {
        $this->typeProduct = $typeProduct;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): static
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of quantity
     */ 
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set the value of quantity
     *
     * @return  self
     */ 
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }
}
