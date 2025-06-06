<?php

declare(strict_types=1);

namespace App\CryptoAlgorithm;

interface CryptoAlgorithmInterface
{
    public function getOptions(mixed ...$input): Options;
    public function encrypt(string $message, Options $options): array;
    public function decrypt(array $encrypted, Options $options): string;
}
