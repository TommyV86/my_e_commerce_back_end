<?php

namespace App\Entity\Dto\CommentDtos;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

#[Groups("visible")]
class CommentDto {

    #[SerializedName("_text")]
    private ?string $text = null;

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
}