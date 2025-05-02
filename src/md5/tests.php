<?php

declare(strict_types=1);

require_once 'md5.php';

error_reporting(E_ALL ^ E_DEPRECATED);

$testCases = [
    [
        'text' => 'world',
    ],
    [
        'text' => 'hello',
    ]
];

echo PHP_EOL . 'Running MD5 crypto algorithm test cases' . PHP_EOL;
foreach ($testCases as $testIndex => $testCase) {
    echo 'Running test #' . $testIndex + 1 . PHP_EOL;

    mainMd5($testCase['text']);

    echo 'End test' . PHP_EOL . PHP_EOL;
}
