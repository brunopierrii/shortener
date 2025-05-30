<?php

namespace App\Controller;

use App\Repository\ShortenedUrlRepositoryInterface;
use App\Service\ShortenerServiceInterface;
use App\Utils\ShortenerHashInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ShortenerController extends AbstractController
{
    public function __construct(
        private readonly ShortenerServiceInterface $service
    ) {
    }

    #[Route('/')]
    public function index(): Response
    {
        return $this->render('home.html.twig');
    }

    #[Route('/shortener', methods: ['POST'])]
    public function shortener(Request $request): JsonResponse
    {
        $content = json_decode($request->getContent(), true);

        return $this->json(
            $this->service->shorten($content['url'])
        );
    }
}