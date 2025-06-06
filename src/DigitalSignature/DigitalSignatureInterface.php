<?php

declare(strict_types=1);

namespace App\DigitalSignature;

use App\CryptoAlgorithm\Options;

interface DigitalSignatureInterface
{
    public function getOptions(mixed ...$input): Options;
    public function sign(string $message, Options $options): string;
    public function verify(string $message, string $signature, Options $options): bool;
}
