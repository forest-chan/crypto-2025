<?php

declare(strict_types=1);

require_once 'rsa.php';
require_once 'utils.php';

error_reporting(E_ALL ^ E_DEPRECATED);

$testCases = [
    [
        'p' => 13,
        'q' => 17,
        'text' => 'hello',
    ],
    [
        'p' => 19,
        'q' => 23,
        'text' => 'world',
    ],
];

echo PHP_EOL;
foreach ($testCases as $testIndex => $testCase) {
    echo 'Running test #' . $testIndex + 1 . PHP_EOL;

    $p = $testCase['p'];
    $q = $testCase['q'];
    $text = $testCase['text'];

    echo "Text = $text, p = $p, q = $q" . PHP_EOL;

    $asciiText = textToAscii($text);

    echo "Ascii Text = " . implode(' ', $asciiText) . PHP_EOL;

    $publicKey = 0;
    $privateKey = 0;
    $encryptedList = [];
    $decryptedList = [];
    foreach ($asciiText as $ascii) {
        [
            $pubicKey,
            $privateKey,
            $encrypted,
            $decrypted,
        ] = rsa($ascii, $p, $q);

        $encryptedList[] = $encrypted;
        $decryptedList[] = $decrypted;
    }

    echo "Public key = $pubicKey, private key = $privateKey" . PHP_EOL;
    echo "Encrypted text = " . implode(' ', $encryptedList) . ", Decrypted text = " . implode(' ', $decryptedList) . PHP_EOL;
    echo "Result Decrypted text = ". asciiToText($decryptedList) . PHP_EOL;
    echo 'End test' . PHP_EOL . PHP_EOL;
}