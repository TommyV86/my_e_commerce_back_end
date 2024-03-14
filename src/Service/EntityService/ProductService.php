<?php

namespace App\Service\EntityService;

use App\Entity\Product;
use App\Service\Mapper\ProductMapper;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class ProductService {

    private SerializerInterface $serializer;
    private EntityManagerInterface $entityManager;
    private ProductMapper $prodMapper;

    public function __construct(
        SerializerInterface $serializer,
        EntityManagerInterface $entityManager,
        ProductMapper $prodMapper
    ){
        $this->serializer = $serializer;
        $this->entityManager = $entityManager;
        $this->prodMapper = $prodMapper;
    }

    public function getAll() : ArrayCollection {

        $prods = $this->entityManager->getRepository(Product::class)->findAll();

        $prodsDto = new ArrayCollection();
        foreach ($prods as $p) {
            $prodsDto->add($this->prodMapper->toDto($p));
        }

        return $prodsDto;
    } 
}

