<?php

namespace App\Service;

interface ShortenerServiceInterface
{
    public function shorten(string $url);
}