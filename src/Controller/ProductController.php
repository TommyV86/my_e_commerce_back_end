<?php

namespace App\Controller;

use App\Service\EntityService\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/product')]
class ProductController extends AbstractController
{

    private ProductService $prodService;

    public function __construct(ProductService $prodService)
    {
        $this->prodService = $prodService;
    }

    #[Route('/all', name: 'app_product', methods: ['GET'])]
    public function index(): JsonResponse
    {
        return $this->json($this->prodService->getAll());
    }
}
