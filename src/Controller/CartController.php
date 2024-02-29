<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

use Symfony\Component\HttpFoundation\Request;
use App\Service\EntityService\CartService;
use App\Repository\PersonRepository;


class CartController extends AbstractController
{

    private bool $isSaved;
    private string $message;

    #[Route('/create_cart', name: 'app_cart', methods: ['POST'])]
    public function index(
        Request $request, 
        CartService $cartService,
        PersonRepository $persRepo): JsonResponse
    {
        //création et persistance du panier en db lorsqu'un user valide 
        //son panier côté navigateur

        //puis le controller de ProductEx sera sollicité pour persister 
        //les prod ex avec le panier persisté avant

        $this->isSaved = $cartService->save($request, $persRepo);
        $this->message = $this->isSaved ? 'cart registered successfully!' : 'error in the server';
        
        return $this->json(['message' => $this->message]);
    }
}
