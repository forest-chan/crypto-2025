<?php

declare(strict_types=1);

namespace App\CryptoAlgorithm\RSA;

use App\CryptoAlgorithm\CryptoAlgorithmInterface;
use App\CryptoAlgorithm\Options;
use LogicException;

class RSA implements CryptoAlgorithmInterface
{
    public function getOptions(mixed ...$input): Options
    {
        [$p, $q] = $input;

        $n = $this->calculateN($p, $q);
        $phi = $this->calculatePhi($p, $q);
        $e = $this->calculateE($phi);
        [$gcd, $x, $y] = $this->calculateEuclidExtended($e, $phi);
        $d = ($x % $phi + $phi) % $phi;

        return new RSAOptions(
            n: (string) $n,
            publicKey: (string) $e,
            privateKey: (string) $d
        );
    }

    public function encrypt(string $message, Options $options): array
    {
        return [
            bcpowmod($message, $options->getPublicKey(), $options->getN()),
        ];
    }

    public function decrypt(array $encrypted, Options $options): string
    {
        if (empty($encrypted)) {
            throw new LogicException('Encrypted list can not be empty');
        }

        return bcpowmod($encrypted[0], $options->getPrivateKey(), $options->getN());
    }

    private function calculatePhi(int $a, int $b): int
    {
        return ($a - 1) * ($b - 1);
    }

    private function calculateEuclid(int $a, int $b): int
    {
        while ($b !== 0) {
            $r = $a % $b;
            $a = $b;
            $b = $r;
        }

        return $a;
    }

    private function calculateEuclidExtended(int $a, int $b): array
    {
        if ($b === 0) {
            return [$a, 1, 0];
        }

        [$gcd, $x1, $y1] = $this->calculateEuclidExtended($b, $a % $b);
        $x = $y1;
        $y = $x1 - (int)($a / $b) * $y1;

        return [$gcd, $x, $y];
    }

    private function calculateE(int $phi): int
    {
        for ($e = 2; $e < $phi; $e++) {
            if ($this->calculateEuclid($e, $phi) === 1) {
                return $e;
            }
        }

        throw new LogicException("E value does not found");
    }

    private function calculateN(int $p, int $q): int
    {
        return $p * $q;
    }
}
