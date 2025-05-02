<?php

declare(strict_types=1);

require_once 'signature.php';

error_reporting(E_ALL ^ E_DEPRECATED);

$testCases = [
    [
        'p' => 7,
        'q' => 11,
        'text' => 'a',
    ],
];

echo PHP_EOL . 'Running Digital Signature crypto algorithm test cases' . PHP_EOL;
foreach ($testCases as $testIndex => $testCase) {
    echo 'Running test #' . $testIndex + 1 . PHP_EOL;

    mainSignature(
        text: $testCase['text'],
        p: $testCase['p'],
        q: $testCase['q'],
    );

    echo 'End test' . PHP_EOL . PHP_EOL;
}
