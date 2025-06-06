<?php

declare(strict_types=1);

namespace App\CryptoAlgorithm\DES;

use App\CryptoAlgorithm\CryptoAlgorithmInterface;
use App\CryptoAlgorithm\Options;
use App\Utils\Utils;

class DESTextDecorator implements CryptoAlgorithmInterface
{
    public function __construct(
        private readonly DES $desDecorated
    ) {
    }

    public function getOptions(mixed ...$input): Options
    {
        return $this->desDecorated->getOptions(...$input);
    }

    public function encrypt(string $message, Options $options): array
    {
        $plainText = Utils::asciiToHex($message);

        return $this->desDecorated->encrypt($plainText, $options);
    }

    public function decrypt(array $encrypted, Options $options): string
    {
        $decryptedHex = $this->desDecorated->decrypt($encrypted, $options);

        return Utils::hexToAscii($decryptedHex);
    }
}
