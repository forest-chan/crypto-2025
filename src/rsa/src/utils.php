<?php

declare(strict_types=1);

function textToAscii(string $text): array
{
    return array_map(
        callback: static fn (string $char): int => ord($char),
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
