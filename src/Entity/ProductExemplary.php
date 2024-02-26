<?php

namespace App\Entity;

use App\Repository\ProductExemplaryRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductExemplaryRepository::class)]
class ProductExemplary
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $quantity = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_purchase = null;

    #[ORM\ManyToOne(inversedBy: 'productExemplaries')]
    private ?Cart $cart = null;

    #[ORM\ManyToOne(inversedBy: 'productExemplaries')]
    private ?Product $product = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getDatePurchase(): ?\DateTimeInterface
    {
        return $this->date_purchase;
    }

    public function setDatePurchase(?\DateTimeInterface $date_purchase): static
    {
        $this->date_purchase = $date_purchase;

        return $this;
    }

    public function getCart(): ?Cart
    {
        return $this->cart;
    }

    public function setCart(?Cart $cart): static
    {
        $this->cart = $cart;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): static
    {
        $this->product = $product;

        return $this;
    }
}
