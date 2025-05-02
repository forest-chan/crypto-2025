<?php

declare(strict_types=1);

function printInput(string $message): void
{
    echo "Input message = $message" . PHP_EOL;
}

function printResultDecryption(string $result): void
{
    echo "Decrypted result = $result" . PHP_EOL;
}

function printStandardPHPRealisationResult(string $result): void
{
    echo "Standard PHP md5 realisation result = $result" . PHP_EOL;
}
