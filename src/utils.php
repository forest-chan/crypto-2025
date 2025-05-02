<?php

declare(strict_types=1);

function asciiToHex(string $ascii): string
{
    return strtoupper(bin2hex($ascii));
}

function hexToAscii(string $hex): string {
    $ascii = '';
    $iterationsCount = strlen($hex);
    for ($i = 0; $i < $iterationsCount; $i += 2) {
        $ascii .= chr(hexdec(substr($hex, $i, 2)));
    }

    return $ascii;
}

function textToAscii(string $text): array
{
    return array_map(
        callback: static fn (string $char): string => (string) ord($char),
        array: str_split($text)
    );
}

function asciiToText(array $ascii): string
{
    return array_reduce(
        array: $ascii,
        callback: static fn (string $resultText, string $char): string => $resultText . chr((int) $char),
        initial: ''
    );
}