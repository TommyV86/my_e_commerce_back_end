<?php

namespace App\Controller;

use App\Entity\Person;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;


class ApiLoginController extends AbstractController
{
    private $serializer;

    public function __construct(
        SerializerInterface $serializer,
    ){
        $this->serializer = $serializer;
    }

    #[Route('/api/login', name: 'api_login', methods: ['POST'])]
    public function index(Request $request): JsonResponse
    {

        $data = $request->getContent();
        $person = $this->serializer->deserialize($data, Person::class, "json");

        if (null === $person) {
            return $this->json([
                'message' => 'missing credentials'
            ], JsonResponse::HTTP_UNAUTHORIZED);
        }

        return $this->json([
            'message' => 'Welcome !',
            'path' => 'path to define',
            'user'  => $person->getEmail()
        ]);
    }
}
