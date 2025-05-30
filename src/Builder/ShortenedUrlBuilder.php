<?php

namespace App\Builder;

use App\Entity\ShortenedUrl;

class ShortenedUrlBuilder
{
    public function __invoke(
        string $shortUrl,
        string $originalUrl,
        ?int $clicks = null
    ): ShortenedUrl {
        $shortenedUrl = new ShortenedUrl();
        $shortenedUrl->setShortUrl($shortUrl);
        $shortenedUrl->setOriginalUrl($originalUrl);
        $shortenedUrl->setClicks($clicks);
        $shortenedUrl->setCreatedAt(new \DateTime());

        return $shortenedUrl;
    }
}
