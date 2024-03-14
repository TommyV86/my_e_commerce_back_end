<?php

namespace App\Entity\Dto\PersonDtos;

use App\Entity\Dto\AddressDtos\AddressDto;
use App\Entity\Dto\CommentDtos\CommentDto;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

#[Groups("visible")]
class PersonDto {

    #[SerializedName("_id")]
    private ?int $id = null;

    #[SerializedName("_firstname")]
    private ?string $firstname = null;

    #[SerializedName("_lastname")]
    private ?string $lastname = null;

    #[SerializedName("_email")]
    private ?string $email = null;
    
    #[SerializedName("_password")]
    private ?string $password= null;

    #[SerializedName("_address")]
    private ?AddressDto $addressDto = null;

    #[SerializedName("_comments")]
    private Collection $commentsDto;

    #[SerializedName("_bookings")]
    private Collection $bookingsDto;



    
    /**
     * Get the value of addressDto
     */ 
    public function getAddressDto() : ?AddressDto
    {
        return $this->addressDto;
    }

    /**
     * Set the value of addressDto
     *
     * @return  self
     */ 
    public function setAddressDto(?AddressDto $addressDto)
    {
        $this->addressDto = $addressDto;

        return $this;
    }


    /**
     * Get the value of commentsDto
     */ 
    public function getCommentsDto() : ?Collection
    {
        return $this->commentsDto;
    }

    /**
     * Set the value of commentsDto
     *
     * @return  self
     */ 
    public function setCommentsDto($commentsDto) : self
    {
        $this->commentsDto = $commentsDto;

        return $this;
    }
    

    /**
     * Get the value of bookingsDto
     */ 
    public function getBookingsDto()
    {
        return $this->bookingsDto;
    }

    /**
     * Set the value of bookingsDto
     *
     * @return  self
     */ 
    public function setBookingsDto($bookingsDto)
    {
        $this->bookingsDto = $bookingsDto;

        return $this;
    }



    /**
     * Get the value of id
     */ 
    public function getId() : ?int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId(?int $id) : self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of lastname
     */ 
    public function getLastname() : ?string
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */ 
    public function setLastname(?string $lastname) : self
    {
        $this->lastname = $lastname;

        return $this;
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

    /**
     * Get the value of firstname
     */ 
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */ 
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }


    
    /**
     * Get the value of password
     */ 
    public function getPassword() : ?string
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password) : self
    {
        $this->password = $password;

        return $this;
    }

    public function __toString()
    {
        return $this->getEmail()
              .$this->getAddressDto();
    }
}