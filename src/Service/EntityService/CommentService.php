<?php

namespace App\Service\EntityService;

use App\Entity\Comment;
use App\Repository\CommentRepository;
use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class CommentService {

    private EntityManagerInterface $entityManager;
    private SerializerInterface $serializer;

    public function __construct(
        EntityManagerInterface $entityManager,
        SerializerInterface $serializer
    )
    {
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
    }

    public function getAll() : mixed {

        $datas = $this->entityManager->getRepository(Comment::class)
                                     ->findAll();

        $comments =  $this->serializer->serialize($datas, 'json', ['groups' => 'visible']);
        return $comments;
    }
}