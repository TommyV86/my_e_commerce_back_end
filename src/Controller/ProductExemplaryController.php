<?php

namespace App\Controller;

use App\Service\EntityService\ProducExemplaryService;
use App\Service\EntityService\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;


class ProductExemplaryController extends AbstractController
{
    private bool $isSaved;
    private string $message;

    #[Route('/confirm_product_exemplary_in_cart', name: 'app_product_exemplary', methods: ['POST'])]
    public function index(
        ProducExemplaryService $producExemplaryService,
        CartService $cartService,
        Request $request): JsonResponse
    {
        // récupération du panier persisté de l'user 
        // persistance des produits exemplaires contenu dans le panier du user dans la db
        
        $this->isSaved = $producExemplaryService->save($request);
        $this->message = $this->isSaved ? 'prod ex with cart are registered successfully!' : 'error in the server';
        
        return $this->json(['message' => $this->message]);
    }
}
