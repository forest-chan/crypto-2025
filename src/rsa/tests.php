<?php

declare(strict_types=1);

require_once 'rsa.php';

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

echo PHP_EOL . 'Running RSA crypto algorithm test cases' . PHP_EOL;
foreach ($testCases as $testIndex => $testCase) {
    echo 'Running test #' . $testIndex + 1 . PHP_EOL;

    mainRsa(
        text: $testCase['text'],
        p: $testCase['p'],
        q: $testCase['q']
    );

    echo 'End test' . PHP_EOL . PHP_EOL;
}
