<?php

declare(strict_types=1);

namespace App\HashFunction\MD5;

use App\HashFunction\HashFunctionInterface;

class MD5 implements HashFunctionInterface
{
    private const int UINT32_MAX = 0xFFFFFFFF;
    private const array S = [
        7, 12, 17, 22, 7, 12, 17, 22, 7, 12, 17, 22, 7, 12, 17, 22,
        5, 9, 14, 20, 5, 9, 14, 20, 5, 9, 14, 20, 5, 9, 14, 20,
        4, 11, 16, 23, 4, 11, 16, 23, 4, 11, 16, 23, 4, 11, 16, 23,
        6, 10, 15, 21, 6, 10, 15, 21, 6, 10, 15, 21, 6, 10, 15, 21,
    ];
    private const array K = [
        0xd76aa478, 0xe8c7b756, 0x242070db, 0xc1bdceee,
        0xf57c0faf, 0x4787c62a, 0xa8304613, 0xfd469501,
        0x698098d8, 0x8b44f7af, 0xffff5bb1, 0x895cd7be,
        0x6b901122, 0xfd987193, 0xa679438e, 0x49b40821,
        0xf61e2562, 0xc040b340, 0x265e5a51, 0xe9b6c7aa,
        0xd62f105d, 0x02441453, 0xd8a1e681, 0xe7d3fbc8,
        0x21e1cde6, 0xc33707d6, 0xf4d50d87, 0x455a14ed,
        0xa9e3e905, 0xfcefa3f8, 0x676f02d9, 0x8d2a4c8a,
        0xfffa3942, 0x8771f681, 0x6d9d6122, 0xfde5380c,
        0xa4beea44, 0x4bdecfa9, 0xf6bb4b60, 0xbebfbc70,
        0x289b7ec6, 0xeaa127fa, 0xd4ef3085, 0x04881d05,
        0xd9d4d039, 0xe6db99e5, 0x1fa27cf8, 0xc4ac5665,
        0xf4292244, 0x432aff97, 0xab9423a7, 0xfc93a039,
        0x655b59c3, 0x8f0ccc92, 0xffeff47d, 0x85845dd1,
        0x6fa87e4f, 0xfe2ce6e0, 0xa3014314, 0x4e0811a1,
        0xf7537e82, 0xbd3af235, 0x2ad7d2bb, 0xeb86d391,
    ];

    private function bitsShiftLeft(int $x, int $c): int
    {
        $shiftResult = (($x << $c) | ($x >> (32 - $c)));

        return $this->apply32BitsMask($shiftResult);
    }

    private function apply32BitsMask(int $x): int
    {
        return $x & self::UINT32_MAX;
    }

    public function hash(string $message): string
    {
        $a0 = 0x67452301;
        $b0 = 0xefcdab89;
        $c0 = 0x98badcfe;
        $d0 = 0x10325476;

        // Предварительная обработка, получаем длину сообщения в байтах (<< 3 == * 8)
        $originalLength = strlen($message);
        $originalBits = $originalLength << 3;

        // Добавляем 1 бит (0x80)
        $message .= "\x80";

        // Добавляем нули
        $padLength = 56 - ($originalLength + 1) % 64;
        if ($padLength < 0) {
            $padLength += 64;
        }
        $message .= str_repeat("\0", $padLength);

        // Добавляем длину исходного сообщения (64 бита, little-endian)
        $message .= pack("V2", $this->apply32BitsMask($originalBits), $originalBits >> 32);

        // Разбиваем сообщение на 512-битные (64-байтные) блоки
        $chunks = str_split($message, 64);

        foreach ($chunks as $chunk) {
            $words = array_values(unpack("V16", $chunk));

            $A = $a0;
            $B = $b0;
            $C = $c0;
            $D = $d0;

            for ($i = 0; $i < 64; $i++) {
                if ($i < 16) { // F(B,C,D) = (B AND C) OR ((NOT B) AND D)
                    $F = ($B & $C) | ((~$B) & $D);
                    $g = $i;
                } elseif ($i < 32) { // F(B,C,D) = (D AND B) OR ((NOT D) AND C)
                    $F = ($D & $B) | ((~$D) & $C);
                    $g = (5 * $i + 1) % 16;
                } elseif ($i < 48) { // F(B,C,D) = B XOR C XOR D
                    $F = $B ^ $C ^ $D;
                    $g = (3 * $i + 5) % 16;
                } else { // F(B,C,D) = C XOR (B OR (NOT D))
                    $F = $C ^ ($B | (~$D));
                    $g = (7 * $i) % 16;
                }

                // Обеспечиваем 32-битное значение
                $F = $this->apply32BitsMask($F + $A + self::K[$i] + $words[$g]);
                $A = $D;
                $D = $C;
                $C = $B;
                $B = $this->apply32BitsMask($B + $this->bitsShiftLeft($F, self::S[$i]));
            }

            $a0 = $this->apply32BitsMask($a0 + $A);
            $b0 = $this->apply32BitsMask($b0 + $B);
            $c0 = $this->apply32BitsMask($c0 + $C);
            $d0 = $this->apply32BitsMask($d0 + $D);
        }

        // Получаем хеш (little-endian to byte string)
        $hash = pack("V4", $a0, $b0, $c0, $d0);

        return bin2hex($hash);
    }
}