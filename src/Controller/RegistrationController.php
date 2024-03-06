<?php

namespace App\Controller;

use App\Service\EntityService\PersonService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

#[Route('/registration')]
class RegistrationController extends AbstractController
{   
    private PersonService $personService;
    private bool $isSaved;
    private string $message;

    public function __construct(PersonService $personService)
    {
        $this->personService = $personService;
    }

    #[Route('/save', name: 'app_registration', methods: ['POST'])]
    public function index(Request $request): JsonResponse
    {
        // créer un service save person
        $this->isSaved = $this->personService->save($request);
        $this->message = $this->isSaved ? 'User registered successfully!' : 'error in the server';
        
        return $this->json(['message' => $this->message]);
    }
}
