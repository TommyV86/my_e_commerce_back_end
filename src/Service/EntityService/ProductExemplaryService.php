<?php

namespace App\Service\EntityService;

use App\Entity\ProductExemplary;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\ORM\EntityManagerInterface;

class ProducExemplaryService {

    private $serializer;
    private $entityManager;

    public function __construct(
        SerializerInterface $serializer,
        EntityManagerInterface $entityManager
    ){
        $this->serializer = $serializer;
        $this->entityManager = $entityManager;
    }

    public function save(Request $request) : bool {

        $data = $request->getContent();
        $prodEx = $this->serializer->deserialize($data, ProductExemplary::class, "json");

        $this->entityManager->persist($prodEx);
        $this->entityManager->flush();

        return true;
    }

}