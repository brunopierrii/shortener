<?php

namespace App\Utils;

class ShortenerHash implements ShortenerHashInterface
{
    private const string BASE62 = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    public function generateHash(string $url, int $length = 8): string
    {
        $microtime = intval(microtime(true));
        $baseConvertTimestamp = substr(base_convert($microtime, 10, 36), 0, 4);
        dd($timestampPart);
    }
}