<?php

namespace App\Controller;

use App\Entity\Person;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Serializer\SerializerInterface;

use Symfony\Component\HttpFoundation\Request;

class RegistrationController extends AbstractController

{   
    private $entityManager;
    private $serializer;
    private $userHashPassword;

    public function __construct(
        EntityManagerInterface $entityManager,
        SerializerInterface $serializer,
        UserPasswordHasherInterface $userHashPassword
    ){
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
        $this->userHashPassword = $userHashPassword;

    }

    #[Route('/registration', name: 'app_registration')]
    public function index(Request $request): JsonResponse
    {
        // créer un service save person

        $data = $request->getContent();
        $person = $this->serializer->deserialize($data, Person::class, "json");

        $person->setPassword(
            $this->userHashPassword->hashPassword(
                $person,
                $person->getPassword()
            )
        );


        $this->entityManager->persist($person);
        $this->entityManager->flush();
        
        return $this->json([
            'message' => 'persist ok !'
        ]);
    }
}
