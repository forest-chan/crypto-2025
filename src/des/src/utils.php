<?php

declare(strict_types=1);

/**
 * Функция превращает строку в ASCII формате в шестнадцатиричную строку.
 */
function asciiToHex(string $ascii): string
{
    return strtoupper(bin2hex($ascii));
}

/**
 * Функция превращает шестнадцатиричную строку в ASCII строку.
 */
function hexToAscii(string $hex): string {
    $ascii = '';
    $iterationsCount = strlen($hex);
    for ($i = 0; $i < $iterationsCount; $i += 2) {
        $ascii .= chr(hexdec(substr($hex, $i, 2)));
    }

    return $ascii;
}

function printResult(array $bitsResult): void
{
    echo 'Result = ' . strtoupper(base_convert(implode('', $bitsResult), 2, 16)) . PHP_EOL;
}

function printResultDecryption(array $bitsResult): void
{
    echo 'Decrypted Result = ' . hexToAscii(base_convert(implode('', $bitsResult), 2, 16)) . PHP_EOL;
}

function printInput(string $plainText, string $key): void
{
    echo 'Plain Text = ' . $plainText . PHP_EOL;
    echo 'Key = ' . $key . PHP_EOL;
}
