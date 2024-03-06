<?php

namespace App\Controller;

use App\Repository\CommentRepository;
use App\Service\EntityService\CommentService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/comment')]
class CommentController extends AbstractController
{
    private CommentService $commentService;

    public function __construct(CommentService $commentService){
        $this->commentService = $commentService;
    }
    
    #[Route('/all', name: 'app_comment', methods: ['GET'])]
    public function index(): JsonResponse
    {
        return $this->json($this->commentService->getAll());
    }
}
