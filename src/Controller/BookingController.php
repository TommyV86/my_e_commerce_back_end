<?php

namespace App\Controller;

use App\Service\EntityService\BookingService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/booking')]
class BookingController extends AbstractController
{
    private BookingService $bookingService;
    private bool $isSaved;
    private string $message;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    #[IsGranted('ROLE_USER', message: 'Vous n\'avez pas les droits suffisants')]
    #[Route('/profile/save', name: 'app_booking', methods: ['POST'])]
    public function index(Request $request): JsonResponse
    {

        $this->isSaved = $this->bookingService->save($request);
        $this->message = $this->isSaved ? 'Booking registered successfully!' : 'error in the server';

        return $this->json(['message' => $this->message]);
    }
}
