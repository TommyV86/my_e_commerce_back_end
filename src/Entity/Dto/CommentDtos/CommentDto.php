<?php

namespace App\Entity\Dto\CommentDtos;

use App\Entity\Dto\PersonDtos\PersonDto;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

#[Groups("visible")]
class CommentDto {

    #[SerializedName("_text")]
    private ?string $text = null;

    #[SerializedName("_person")]
    private ?PersonDto $personDto = null;
    /**
     * Get the value of text
     */ 
    public function getText() : ?string
    {
        return $this->text;
    }

    /**
     * Set the value of text
     *
     * @return  self
     */ 
    public function setText(?string $text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get the value of personDto
     */ 
    public function getPersonDto()
    {
        return $this->personDto;
    }

    /**
     * Set the value of personDto
     *
     * @return  self
     */ 
    public function setPersonDto($personDto)
    {
        $this->personDto = $personDto;

        return $this;
    }
}