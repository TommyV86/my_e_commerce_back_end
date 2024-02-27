<?php

namespace App\Entity;

use App\Repository\CartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CartRepository::class)]
class Cart
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?float $total_sum = null;

    #[ORM\OneToOne(mappedBy: 'cart', cascade: ['persist', 'remove'])]
    private ?Person $person = null;

    #[ORM\OneToMany(targetEntity: ProductExemplary::class, mappedBy: 'cart')]
    private Collection $productExemplaries;

    public function __construct()
    {
        $this->productExemplaries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTotalSum(): ?float
    {
        return $this->total_sum;
    }

    public function setTotalSum(?float $total_sum): static
    {
        $this->total_sum = $total_sum;

        return $this;
    }

    public function getPerson(): ?Person
    {
        return $this->person;
    }

    public function setPerson(?Person $person): static
    {
        // unset the owning side of the relation if necessary
        if ($person === null && $this->person !== null) {
            $this->person->setCart(null);
        }

        // set the owning side of the relation if necessary
        if ($person !== null && $person->getCart() !== $this) {
            $person->setCart($this);
        }

        $this->person = $person;

        return $this;
    }

    /**
     * @return Collection<int, ProductExemplary>
     */
    public function getProductExemplaries(): Collection
    {
        return $this->productExemplaries;
    }

    public function addProductExemplary(ProductExemplary $productExemplary): static
    {
        if (!$this->productExemplaries->contains($productExemplary)) {
            $this->productExemplaries->add($productExemplary);
            $productExemplary->setCart($this);
        }

        return $this;
    }

    public function removeProductExemplary(ProductExemplary $productExemplary): static
    {
        if ($this->productExemplaries->removeElement($productExemplary)) {
            // set the owning side to null (unless already changed)
            if ($productExemplary->getCart() === $this) {
                $productExemplary->setCart(null);
            }
        }

        return $this;
    }
}