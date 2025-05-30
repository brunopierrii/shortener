<?php

namespace App\Service;

use App\Builder\ShortenedUrlBuilder;
use App\Repository\ShortenedUrlRepositoryInterface;
use App\Utils\ShortenerHashInterface;
use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\RequestStack;

readonly class ShortenerService implements ShortenerServiceInterface
{
    public function __construct(
        private ShortenerHashInterface $shortenerHash,
        private ShortenedUrlRepositoryInterface $repository,
        private RequestStack $requestStack,
    ) {
    }

    public function shorten(string $url): array
    {
        $this->checkUrl($url);

        try {
            $urlHash = $this->shortenerHash->generateHash($url);
            $shortenerUrl = (new ShortenedUrlBuilder())(
                $urlHash,
                $url
            );

            $this->repository->persist($shortenerUrl);

            return [
                'short_url' => 'https://' . $this->requestStack->getMainRequest()->getHost() . '/' . $urlHash,
                'original_url' => $url,
            ];
        } catch (\Exception $e) {
            throw new \Exception('Ocorreu um erro inesperado');
        }
    }

    public function checkUrl(string $url)
    {
        $client = new Client([
            'base_uri' => $url,
            'verify' => false
        ]);

        try {
            $client->get('');
        } catch (\Exception $e) {
            throw new \Exception('Check the url: ' . $url);
        }
    }
}