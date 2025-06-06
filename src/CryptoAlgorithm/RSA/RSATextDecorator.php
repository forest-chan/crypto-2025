<?php

declare(strict_types=1);

namespace App\CryptoAlgorithm\RSA;

use App\CryptoAlgorithm\CryptoAlgorithmInterface;
use App\CryptoAlgorithm\Options;
use App\Utils\Utils;

class RSATextDecorator implements CryptoAlgorithmInterface
{
    public function __construct(
        private readonly CryptoAlgorithmInterface $rsaDecorated,
    ) {
    }

    public function getOptions(mixed ...$input): Options
    {
        return $this->rsaDecorated->getOptions(...$input);
    }

    public function encrypt(string $message, Options $options): array
    {
        $encryptedList = [];

        foreach (Utils::textToAscii($message) as $ascii) {
            $encryptedList[] = $this->rsaDecorated->encrypt($ascii, $options);
        }

        return array_merge(...$encryptedList);
    }

    public function decrypt(array $encrypted, Options $options): string
    {
        $decryptedList = [];

        foreach ($encrypted as $number) {
            $decryptedList[] = $this->rsaDecorated->decrypt([$number], $options);
        }

        return Utils::asciiToText($decryptedList);
    }
}
