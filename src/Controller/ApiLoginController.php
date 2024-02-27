<?php

namespace App\Controller;

use App\Entity\Person;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\PersonRepository;



class ApiLoginController extends AbstractController
{
    private $serializer;
    private $entityManager;


    public function __construct(
        SerializerInterface $serializer,
        EntityManagerInterface $entityManager
    ){
        $this->serializer = $serializer;
        $this->entityManager = $entityManager;
    }

    #[Route('/api/login', name: 'api_login', methods: ['POST'])]
    public function index(Request $request, PersonRepository $persRepo): JsonResponse
    {

        $data = $request->getContent();
        $emailIntoArray = json_decode($data, true);
        $email = (string) $emailIntoArray['username'];

        //faire une requete nommée dans le repo de person pour trouver l'user via l email
        $person = $persRepo->findOneByEmail($email);

        if (null === $person) {
            return $this->json([
                'message' => 'missing credentials'
            ], JsonResponse::HTTP_UNAUTHORIZED);
        }

        return $this->json([
            'message' => 'login ok ! ',
            'path' => 'path to define',
            'person from db' => $person
        ]);
    }
}
