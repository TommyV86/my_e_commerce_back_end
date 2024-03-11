<?php

namespace App\Entity\Dto\PersonDtos;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

#[Groups("visible")]
class PersonCommentsDto {

    #[SerializedName("_email")]
    private ?string $email = null;

    #[SerializedName("_comments")]
    private Collection $commentsDto;

    public function __construct()
    {
        $this->commentsDto = new ArrayCollection();
    }

    /**
     * @return Collection<int, CommentDto>
     */
    public function getCommentsDto(): Collection
    {
        return $this->commentsDto;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail() : ?string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail(?string $email)
    {
        $this->email = $email;

        return $this;
    }
}