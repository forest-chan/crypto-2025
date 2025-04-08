<?php

declare(strict_types=1);

require_once 'des.php';

error_reporting(E_ALL ^ E_DEPRECATED);

$testCases = [
    [
        'plaintText' => 'hello',
        'key' => '133457799BBCDFF1',
    ],
    [
        'plaintText' => 'world',
        'key' => '0F1571C947D9E859',
    ],
];

echo PHP_EOL;
foreach ($testCases as $testIndex => $testCase) {
    echo 'Running test #' . $testIndex + 1 . PHP_EOL;

    main(
        plainText: $testCase['plaintText'],
        key: $testCase['key'],
    );

    echo 'End test' . PHP_EOL . PHP_EOL;
}
