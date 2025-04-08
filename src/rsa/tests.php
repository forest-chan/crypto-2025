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

    main(
        p: $testCase['p'],
        q: $testCase['q'],
        text: $testCase['text'],
    );

    echo 'End test' . PHP_EOL . PHP_EOL;
}
