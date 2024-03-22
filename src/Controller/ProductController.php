<?php

namespace App\Controller;

use App\Service\EntityService\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/product')]
class ProductController extends AbstractController
{

    private string $name;

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

    #[Route('/getByName', name: 'app_product_details', methods: ['GET'])]
    public function getOneByName(Request $request): JsonResponse
    {
        $this->name = $request->query->getString('name');
        return $this->json($this->prodService->getOneByName($this->name));
    }
}
