<?php

declare(strict_types=1);

namespace App\Utils;

class Utils
{
    public static function asciiToHex(string $ascii): string
    {
        return strtoupper(bin2hex($ascii));
    }

    public static function hexToAscii(string $hex): string {
        $ascii = '';
        $iterationsCount = strlen($hex);
        for ($i = 0; $i < $iterationsCount; $i += 2) {
            $ascii .= chr(hexdec(substr($hex, $i, 2)));
        }

        return $ascii;
    }

    public static function textToAscii(string $text): array
    {
        return array_map(
            callback: static fn (string $char): string => (string) ord($char),
            array: str_split($text)
        );
    }

    public static function asciiToText(array $ascii): string
    {
        return array_reduce(
            array: $ascii,
            callback: static fn (string $resultText, int $char): string => $resultText . chr($char),
            initial: ''
        );
    }
}
