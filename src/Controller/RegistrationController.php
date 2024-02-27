<?php

namespace App\Controller;

use App\Service\EntityService\PersonService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

class RegistrationController extends AbstractController
{   
    private bool $isSaved;
    private string $message;

    #[Route('/registration', name: 'app_registration')]
    public function index(
        PersonService $personService, 
        Request $request): JsonResponse
    {
        // créer un service save person
        $this->isSaved = $personService->save($request);
        $this->message = $this->isSaved ? 'User registered successfully!' : 'error in the server';
        
        return $this->json(['message' => $this->message]);
    }
}
