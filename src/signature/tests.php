<?php

declare(strict_types=1);

require_once 'signature.php';

error_reporting(E_ALL ^ E_DEPRECATED);

$testCases = [
    [
        'p' => 7,
        'q' => 11,
        'textToSign' => 'a',
        'textToVerify' => 'a',
    ],
    [
        'p' => 7,
        'q' => 11,
        'textToSign' => 'a',
        'textToVerify' => 'b',
    ],
];

echo PHP_EOL . 'Running Digital Signature crypto algorithm test cases' . PHP_EOL;
foreach ($testCases as $testIndex => $testCase) {
    echo 'Running test #' . $testIndex + 1 . PHP_EOL;

    mainSignature(
        textToSign: $testCase['textToSign'],
        textToVerify: $testCase['textToVerify'],
        p: $testCase['p'],
        q: $testCase['q']
    );

    echo 'End test' . PHP_EOL . PHP_EOL;
}
