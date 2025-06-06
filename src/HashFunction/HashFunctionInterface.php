<?php

declare(strict_types=1);

namespace App\HashFunction;

interface HashFunctionInterface
{
    public function hash(string $message): string;
}
