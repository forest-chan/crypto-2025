<?php

declare(strict_types=1);

namespace App\CryptoAlgorithm\DES;

use App\CryptoAlgorithm\Options;

class DESOptions extends Options
{
    /** @var array<array<int>> $reversedIterationKeys */
    private readonly array $reversedIterationKeys;

    /** @var array<array<int>> $iterationKeys */
    public function __construct(
        private readonly array $iterationKeys
    ) {
        $this->reversedIterationKeys = array_reverse($iterationKeys);
    }

    /** @return array<array<int>> */
    public function getIterationKeys(): array
    {
        return $this->iterationKeys;
    }

    /** @return array<array<int>> */
    public function getReversedIterationKeys(): array
    {
        return $this->reversedIterationKeys;
    }
}
