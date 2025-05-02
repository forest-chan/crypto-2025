<?php

declare(strict_types=1);

require_once __DIR__ . '/../md5/md5.php';
require_once __DIR__ . '/../rsa/rsa.php';

function sign(string $message, int $privateKey, int $n): string
{
    $hashMessage = hashMd5($message);
    $hashNumber = base_convert($hashMessage, 16, 10);

    return encryptRsa($hashNumber, $privateKey, $n);
}

function verify(string $message, string $signature, int $publicKey, int $n): bool
{
    $hashMessage = hashMd5($message);
    $hashNumber = base_convert($hashMessage, 16, 10);
    $result = decryptRsa($signature, $publicKey, $n);

    return bcmod($hashNumber, (string) $n) === $result;
}

function mainSignature(
    string $textToSign,
    string $textToVerify,
    int $p,
    int $q
): void {
    echo "Input text to sign = $textToSign, input text to verify = $textToVerify, p = $p, q = $q" . PHP_EOL;

    $n = calculateN($p, $q);
    [$publicKey, $privateKey] = getRsaKeys($p, $q);
    $signature = sign($textToSign, $privateKey, $n);

    echo "Signature = $signature" . PHP_EOL;

    $verificationResult = verify($textToVerify, $signature, $publicKey, $n);

    echo $verificationResult === true ? 'Verification result successful' . PHP_EOL : 'Verification result failed' . PHP_EOL;
}
