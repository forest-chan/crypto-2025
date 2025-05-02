<?php

declare(strict_types=1);

require_once 'utils.php';

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

function rsa(int $message, int $p, int $q): array
{
    $n = $p * $q;
    $phi = calculatePhi($p, $q);
    $e = calculateE($phi);
    [$gcd, $x, $y] = calculateEuclidExtended($e, $phi);
    $d = ($x % $phi + $phi) % $phi;

    $encrypted = bcpowmod((string) $message, (string) $e, (string) $n);
    $decrypted = bcpowmod($encrypted, (string) $d, (string) $n);

    return [
        'publicKey' => $e,
        'privateKey' => $d,
        'encrypted' => $encrypted,
        'decrypted' => $decrypted,
    ];
}

function main(string $text, int $p, int $q): void
{
    printInput($text, $p, $q);

    $asciiText = textToAscii($text);

    printAsciiText($asciiText);

    $publicKey = 0;
    $privateKey = 0;
    $encryptedList = [];
    $decryptedList = [];
    foreach ($asciiText as $ascii) {
        $rsaResult = rsa($ascii, $p, $q);

        $publicKey = $rsaResult['publicKey'];
        $privateKey = $rsaResult['privateKey'];
        $encryptedList[] = $rsaResult['encrypted'];
        $decryptedList[] = $rsaResult['decrypted'];
    }

    printKeys($publicKey, $privateKey);
    printResultDecryption($encryptedList, $decryptedList);
}
