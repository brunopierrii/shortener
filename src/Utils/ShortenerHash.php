<?php

namespace App\Utils;

class ShortenerHash implements ShortenerHashInterface
{
    private const string BASE62 = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    public function generateHash(string $url, int $length = 8): string
    {
        $microtime = intval(microtime(true));
        $baseConvertTimestamp = substr(base_convert($microtime, 10, 36), 0, 4);
        $randomHex = bin2hex(random_bytes(4));
        $hash = substr(hash('sha512', $url . $randomHex . $baseConvertTimestamp), 0, 8);

        $combinedHash = $baseConvertTimestamp . $randomHex . $hash;

        return self::toBase62($combinedHash, $length);
    }

    private static function toBase62(string $initialHash, int $length): string
    {
        $finalHash = '';
        $hash = hash('sha256', $initialHash);
        $number = gmp_init($hash, 16);
        $base62length = strlen(self::BASE62);

        while (gmp_cmp($number, 0) > 0 && strlen($finalHash) < $base62length) {
            $remainder = gmp_intval(gmp_mod($number, $base62length));
            $finalHash = self::BASE62[$remainder] . $finalHash;
            $number = gmp_div($number, $base62length);
        }

        return substr($finalHash, 0, $length);
    }
}