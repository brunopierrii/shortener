<?php

namespace App\Repository;

use App\Entity\ShortenedUrl;

interface ShortenedUrlRepositoryInterface
{
    public function persist(ShortenedUrl $shortenedUrl): void;
}