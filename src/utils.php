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
    $text = '';
    foreach ($ascii as $char) {
        $text .= chr((int) $char);
    }

    return $text;
}