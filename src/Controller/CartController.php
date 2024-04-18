<?php

namespace App\Controller;

use App\Entity\Dto\PersonDtos\PersonDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

use Symfony\Component\HttpFoundation\Request;
use App\Service\EntityService\CartService;
use App\Repository\PersonRepository;
use App\Service\Mapper\PersonMapper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Serializer\SerializerInterface;

use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

#[Route('/cart')]
class CartController extends AbstractController
{
    private CartService $cartService;
    private bool $isSaved;
    private string $message;

    private SerializerInterface $serializer;
    private EntityManagerInterface $entityManager;
    private PersonMapper $personMapper;

    private JWTTokenManagerInterface $jwtToken;
    private TokenStorageInterface $tokenStorage;

    
    public function __construct(CartService $cartService,SerializerInterface $serializer,
        EntityManagerInterface $entityManager,PersonMapper $personMapper, 
        JWTTokenManagerInterface $jwtToken,
        TokenStorageInterface $tokenStorage)
    {
        $this->cartService = $cartService;
        $this->serializer = $serializer;
        $this->entityManager = $entityManager;
        $this->personMapper = $personMapper;
        $this->jwtToken = $jwtToken;
        $this->tokenStorage = $tokenStorage;
    }

    #[Route('/profile/create', name: 'app_cart', methods: ['POST'])]
    public function index(Request $request): JsonResponse
    {
        
        //création et persistance du panier en db lorsqu'un user valide 
        //son panier côté navigateur

        //puis le controller de ProductEx sera sollicité pour persister 
        //les prod ex avec le panier persisté avant

        //$this->isSaved = $this->cartService->save($request);
        //$this->message = $this->isSaved ? 'cart registered successfully!' : 'error in the server';
        
        return $this->json(['message' => $this->cartService->save($request)]);
    }
}
