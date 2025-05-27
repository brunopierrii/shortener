<?php

namespace App\Controller;

use App\Utils\ShortenerHashInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ShortnerController extends AbstractController
{
    public function __construct(private readonly ShortenerHashInterface $shortnerHash)
    {
    }

    #[Route('/')]
    public function index(): Response
    {
        return $this->render('home.html.twig');
    }

    #[Route('/shortner', methods: ['POST'])]
    public function shortner(Request $request): JsonResponse
    {
        $content = json_decode($request->getContent(), true);
        $hashUrl = $this->shortnerHash->generateHash($content['url']);

        return $this->json(
            [
                'short_url' => 'https://' . $request->getHost() . '/' . $hashUrl,
                'original_url' => $content['url'],
            ]
        );
    }
}