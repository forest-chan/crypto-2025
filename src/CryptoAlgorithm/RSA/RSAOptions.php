<?php

declare(strict_types=1);

namespace App\CryptoAlgorithm\RSA;

use App\CryptoAlgorithm\Options;

class RSAOptions extends Options
{
    public function __construct(
        private readonly string $n,
        private readonly string $publicKey,
        private readonly string $privateKey
    ) {
    }

    public function getPublicKey(): string
    {
        return $this->publicKey;
    }

    public function getPrivateKey(): string
    {
        return $this->privateKey;
    }

    public function getN(): string
    {
        return $this->n;
    }
}
