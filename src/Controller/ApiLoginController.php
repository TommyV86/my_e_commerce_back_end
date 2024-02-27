<?php

namespace App\Controller;

use App\Entity\Person;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

use Symfony\Component\HttpFoundation\Request;
use App\Service\EntityService\PersonService;
use App\Repository\PersonRepository;


class ApiLoginController extends AbstractController
{
    private Person $person;

    #[Route('/api/login', name: 'api_login', methods: ['POST'])]
    public function index(Request $request, 
                          PersonRepository $persRepo,
                          PersonService $personService): JsonResponse
    {
        $this->person = $personService->login($request, $persRepo);

        return $this->json([
            'message' => 'login ok ! ',
            'path' => 'path to define',
            'person from db' => $this->person
        ]);

    }
}
