<?php

namespace App\Utils;

interface ShortenerHashInterface
{
    public function generateHash(string $url, int $length = 8): string;
}