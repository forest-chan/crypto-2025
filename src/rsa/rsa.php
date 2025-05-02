<?php

declare(strict_types=1);

require_once __DIR__ . "/../utils.php";

function calculatePhi(int $a, int $b): int
{
    return ($a - 1) * ($b - 1);
}

function calculateEuclid(int $a, int $b): int
{
   while ($b !== 0) {
       $r = $a % $b;
       $a = $b;
       $b = $r;
   }

   return $a;
}

function calculateEuclidExtended(int $a, int $b): array
{
    if ($b === 0) {
        return [$a, 1, 0];
    }

    [$gcd, $x1, $y1] = calculateEuclidExtended($b, $a % $b);
    $x = $y1;
    $y = $x1 - (int)($a / $b) * $y1;

    return [$gcd, $x, $y];
}

function calculateE(int $phi): int
{
    for ($e = 2; $e < $phi; $e++) {
        if (calculateEuclid($e, $phi) === 1) {
            return $e;
        }
    }

    throw new LogicException("E value does not found");
}

function getRsaKeys(int $p, int $q): array
{
    $phi = calculatePhi($p, $q);
    $e = calculateE($phi);
    [$gcd, $x, $y] = calculateEuclidExtended($e, $phi);
    $d = ($x % $phi + $phi) % $phi;

    return [$e, $d];
}

function calculateN(int $p, int $q): int
{
    return $p * $q;
}

function encryptRsa(string $message, int $publicKey, int $n): string
{
    return bcpowmod($message, (string) $publicKey, (string) $n);
}

function decryptRsa(string $message, int $privateKey, int $n): string
{
    return bcpowmod($message, (string) $privateKey, (string) $n);
}

function mainRsa(string $text, int $p, int $q): void
{
    echo "Text = $text, p = $p, q = $q" . PHP_EOL;

    $asciiText = textToAscii($text);

    echo "Ascii Text = " . implode(' ', $asciiText) . PHP_EOL;

    $n = calculateN($p, $q);
    [$publicKey, $privateKey] = getRsaKeys($p, $q);

    echo "Public key = $publicKey, private key = $privateKey" . PHP_EOL;

    $encryptedList = [];
    $decryptedList = [];
    foreach ($asciiText as $ascii) {
        $encrypted = encryptRsa($ascii, $publicKey, $n);

        $encryptedList[] = $encrypted;
        $decryptedList[] = decryptRsa($encrypted, $privateKey, $n);
    }

    echo "Encrypted text = " . implode(' ', $encryptedList) . ", Decrypted text = " . implode(' ', $decryptedList) . PHP_EOL;
    echo "Result Decrypted text = ". asciiToText($decryptedList) . PHP_EOL;
}
