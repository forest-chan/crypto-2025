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

function printInput(string $text, int $p, int $q): void
{
    echo "Text = $text, p = $p, q = $q" . PHP_EOL;
}

function printAsciiText(array $asciiText): void
{
    echo "Ascii Text = " . implode(' ', $asciiText) . PHP_EOL;
}

function printKeys(int $publicKey, int $privateKey): void
{
    echo "Public key = $publicKey, private key = $privateKey" . PHP_EOL;
}

function printResultDecryption(array $encryptedList, array $decryptedList): void
{
    echo "Encrypted text = " . implode(' ', $encryptedList) . ", Decrypted text = " . implode(' ', $decryptedList) . PHP_EOL;
    echo "Result Decrypted text = ". asciiToText($decryptedList) . PHP_EOL;
}
