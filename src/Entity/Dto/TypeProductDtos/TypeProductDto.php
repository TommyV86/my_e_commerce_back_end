<?php

namespace App\Entity\Dto\TypeProductDtos;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

#[Groups("visible")]
class TypeProductDto {

    #[SerializedName("_name")]
    private ?string $name = null;


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
}