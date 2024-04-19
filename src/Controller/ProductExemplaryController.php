<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

use Symfony\Component\Security\Http\Attribute\IsGranted;
use App\Service\EntityService\ProductExemplaryService;
use App\Repository\CartRepository;

#[Route('/product_exemplary')]
class ProductExemplaryController extends AbstractController
{
    private ProductExemplaryService $productExemplaryService;
    private bool $isSaved;
    private string $message;

    public function __construct(ProductExemplaryService $productExemplaryService)
    {
        $this->productExemplaryService = $productExemplaryService;
    }

    #[Route('/profile/confirm_product_exemplary_in_cart', name: 'app_product_exemplary', methods: ['POST'])]
    public function index(Request $request): JsonResponse
    {
        // récupération du panier persisté de l'user 
        // persistance des produits exemplaires contenu dans le panier du user dans la db
        
        $this->isSaved = $this->productExemplaryService->save($request);
        $this->message = $this->isSaved ? 'prod ex with cart are registered successfully!' : 'error in the server';
        
        return $this->json(['pord ex controller' => $this->message]);

    }
}
