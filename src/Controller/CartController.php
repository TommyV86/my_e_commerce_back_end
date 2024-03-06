<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

use Symfony\Component\HttpFoundation\Request;
use App\Service\EntityService\CartService;
use App\Repository\PersonRepository;

use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/cart')]
class CartController extends AbstractController
{
    private CartService $cartService;
    private bool $isSaved;
    private string $message;
    
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    #[IsGranted('ROLE_USER', message: 'Vous n\'avez pas les droits suffisants')]
    #[Route('/profile/create', name: 'app_cart', methods: ['POST'])]
    public function index(Request $request): JsonResponse
    {
        //création et persistance du panier en db lorsqu'un user valide 
        //son panier côté navigateur

        //puis le controller de ProductEx sera sollicité pour persister 
        //les prod ex avec le panier persisté avant

        $this->isSaved = $this->cartService->save($request);
        $this->message = $this->isSaved ? 'cart registered successfully!' : 'error in the server';
        
        return $this->json(['message' => $this->message]);
    }
}
