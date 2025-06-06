<?php

declare(strict_types=1);

namespace App\DigitalSignature\DigitalSignatureMD5RSA;

use App\CryptoAlgorithm\CryptoAlgorithmInterface;
use App\CryptoAlgorithm\Options;
use App\DigitalSignature\DigitalSignatureInterface;
use App\HashFunction\HashFunctionInterface;

class DigitalSignatureMD5RSA implements DigitalSignatureInterface
{
    public function __construct(
        private readonly HashFunctionInterface $md5,
        private readonly CryptoAlgorithmInterface $rsa,
    ) {
    }

    public function getOptions(mixed ...$input): Options
    {
        return $this->rsa->getOptions(...$input);
    }

    public function sign(string $message, Options $options): string
    {
        $hashMessage = $this->md5->hash($message);
        $hashNumber = base_convert($hashMessage, 16, 10);

        return $this->rsa->decrypt([$hashNumber], $options);
    }

    public function verify(string $message, string $signature, Options $options): bool
    {
        $hashMessage = $this->md5->hash($message);
        $hashNumber = base_convert($hashMessage, 16, 10);
        $result = $this->rsa->encrypt($signature, $options);

        return bcmod($hashNumber, $options->getN()) === $result[0];
    }
}
