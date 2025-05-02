<?php

declare(strict_types=1);

require_once __DIR__ . "/../utils.php";

// S-блоки
$s1 = [
    [14,4,13,1,2,15,11,8,3,10,6,12,5,9,0,7],
    [0,15,7,4,14,2,13,1,10,6,12,11,9,5,3,8],
    [4,1,14,8,13,6,2,11,15,12,9,7,3,10,5,0],
    [15,12,8,2,4,9,1,7,5,11,3,14,10,0,6,13],
];
$s2 = [
    [15,1,8,14,6,11,3,4,9,7,2,13,12,0,5,10],
    [3,13,4,7,15,2,8,14,12,0,1,10,6,9,11,5],
    [0,14,7,11,10,4,13,1,5,8,12,6,9,3,2,15],
    [13,8,10,1,3,15,4,2,11,6,7,12,0,5,14,9],
];
$s3 = [
    [10,0,9,14,6,3,15,5,1,13,12,7,11,4,2,8],
    [13,7,0,9,3,4,6,10,2,8,5,14,12,11,15,1],
    [13,6,4,9,8,15,3,0,11,1,2,12,5,10,14,7],
    [1,10,13,0,6,9,8,7,4,15,14,3,11,5,2,12],
];
$s4 = [
    [7,13,14,3,0,6,9,10,1,2,8,5,11,12,4,15],
    [13,8,11,5,6,15,0,3,4,7,2,12,1,10,14,9],
    [10,6,9,0,12,11,7,13,15,1,3,14,5,2,8,4],
    [3,15,0,6,10,1,13,8,9,4,5,11,12,7,2,14],
];
$s5 = [
    [2,12,4,1,7,10,11,6,8,5,3,15,13,0,14,9],
    [14,11,2,12,4,7,13,1,5,0,15,10,3,9,8,6],
    [4,2,1,11,10,13,7,8,15,9,12,5,6,3,0,14],
    [11,8,12,7,1,14,2,13,6,15,0,9,10,4,5,3],
];
$s6 = [
    [12,1,10,15,9,2,6,8,0,13,3,4,14,7,5,11],
    [10,15,4,2,7,12,9,5,6,1,13,14,0,11,3,8],
    [9,14,15,5,2,8,12,3,7,0,4,10,1,13,11,6],
    [4,3,2,12,9,5,15,10,11,14,1,7,6,0,8,13],
];
$s7 = [
    [4,11,2,14,15,0,8,13,3,12,9,7,5,10,6,1],
    [13,0,11,7,4,9,1,10,14,3,5,12,2,15,8,6],
    [1,4,11,13,12,3,7,14,10,15,6,8,0,5,9,2],
    [6,11,13,8,1,4,10,7,9,5,0,15,14,2,3,12],
];
$s8 = [
    [13,2,8,4,6,15,11,1,10,9,3,14,5,0,12,7],
    [1,15,13,8,10,3,7,4,12,5,6,11,0,14,9,2],
    [7,11,4,1,9,12,14,2,0,6,10,13,15,3,5,8],
    [2,1,14,7,4,10,8,13,15,12,9,0,3,5,6,11],
];
$sBox = [
    $s1,
    $s2,
    $s3,
    $s4,
    $s5,
    $s6,
    $s7,
    $s8,
];

// Таблица начальной перестановки
$initialPermutationTable = [
    58, 50, 42, 34, 26, 18, 10, 2,
    60, 52, 44, 36, 28, 20, 12, 4,
    62, 54, 46, 38, 30, 22, 14, 6,
    64, 56, 48, 40, 32, 24, 16, 8,
    57, 49, 41, 33, 25, 17, 9, 1,
    59, 51, 43, 35, 27, 19, 11, 3,
    61, 53, 45, 37, 29, 21, 13, 5,
    63, 55, 47, 39, 31, 23, 15, 7,
];
// Таблица финальной перестановки
$finalPermutationTable = [
    40, 8, 48, 16, 56, 24, 64, 32,
    39, 7, 47, 15, 55, 23, 63, 31,
    38, 6, 46, 14, 54, 22, 62, 30,
    37, 5, 45, 13, 53, 21, 61, 29,
    36, 4, 44, 12, 52, 20, 60, 28,
    35, 3, 43, 11, 51, 19, 59, 27,
    34, 2, 42, 10, 50, 18, 58, 26,
    33, 1, 41, 9, 49, 17, 57, 25,
];
// Таблица функции расширения
$expansionPermutationTable = [
    32, 1, 2, 3, 4, 5, 4, 5,
    6, 7, 8, 9, 8, 9, 10, 11,
    12, 13, 12, 13, 14, 15, 16, 17,
    16, 17, 18, 19, 20, 21, 20, 21,
    22, 23, 24, 25, 24, 25, 26, 27,
    28, 29, 28, 29, 30, 31, 32, 1,
];
// Таблица перестановок S-блоков
$sBoxPermutationTable = [
    16,  7, 20, 21,
    29, 12, 28, 17,
    1, 15, 23, 26,
    5, 18, 31, 10,
    2,  8, 24, 14,
    32, 27,  3,  9,
    19, 13, 30,  6,
    22, 11,  4, 25,
];
// Таблица перестановок при генерировании ключей итерации
$keyPermutationTable = [
    57, 49, 41, 33, 25, 17, 9,
    1, 58, 50, 42, 34, 26, 18,
    10, 2, 59, 51, 43, 35, 27,
    19, 11, 3, 60, 52, 44, 36,
    63, 55, 47, 39, 31, 23, 15,
    7, 62, 54, 46, 38, 30, 22,
    14, 6, 61, 53, 45, 37, 29,
    21, 13, 5, 28, 20, 12, 4,
];
// Таблица сдвигов для генерирования ключей итерации
$keyShiftTable = [
    1, 1, 2, 2,
    2, 2, 2, 2,
    1, 2, 2, 2,
    2, 2, 2, 1,
];
// Таблица сжатия при генерировании ключа итерации
$keyCompressionTable = [
    14, 17, 11, 24, 1, 5,
    3, 28, 15, 6, 21, 10,
    23, 19, 12, 4, 26, 8,
    16, 7, 27, 20, 13, 2,
    41, 52, 31, 37, 47, 55,
    30, 40, 51, 45, 33, 48,
    44, 49, 39, 56, 34, 53,
    46, 42, 50, 36, 29, 32,
];

/**
 * Функция выполняет операцию перестановки.
 * $value - входной массив, который будет подвергаться перестановке. Это массив битов.
 * $permutationTable — таблица перестановки, которая определяет, в каком порядке должны быть расположены элементы из массива $value.
 * Таблица $permutationTable — это массив индексов, которые указывают на позицию каждого элемента $value в итоговом массиве $permutedValue.
 *
 * @param array<int> $value
 * @param array<int> $permutationTable
 *
 * @return array<int>
 */
function permuteArrays(array $value, array $permutationTable, int $bitsNumber): array
{
    $permutedValue = [];
    for ($i = 0; $i < $bitsNumber; $i++) {
        $bitIndex = $permutationTable[$i] - 1;
        $permutedValue[] = $value[$bitIndex] ?? 0;
    }

    return $permutedValue;
}

/**
 * Функция выполняет побитовую операцию XOR (исключающее ИЛИ) между каждой парой элементов из массивов $valueA и $valueB.
 *
 * @param array<int> $valueA
 * @param array<int> $valueB
 *
 * @return array<int>
 */
function xorArrays(array $valueA, array $valueB): array
{
    $xorResult = [];
    $iterationsCount = count($valueA);
    for ($i = 0; $i < $iterationsCount; $i++) {
        $xorResult[] = $valueA[$i] ^ $valueB[$i];
    }

    return $xorResult;
}

/**
 * Функция выполняет побитовый сдвиг на $shiftsCount битов влево в массиве битов $value.
 *
 * @param array<int> $value
 *
 * @return array<int>
 */
function shiftLeft(array $value, int $shiftsCount): array
{
    for ($i = 0; $i < $shiftsCount; $i++) {
        $firstBit = array_shift($value);
        $value[] = $firstBit;
    }

    return $value;
}

function getIterationKeys(array $keyBits): array
{
    global $keyShiftTable, $keyPermutationTable, $keyCompressionTable;

    $iterationKeys = [];
    $keyBits = permuteArrays($keyBits, $keyPermutationTable, 56);

    $leftPart = array_slice($keyBits, 0, 28);
    $rightPart = array_slice($keyBits, 28, 28);

    for ($i = 0; $i < 16; $i++) {
        $leftPart = shiftLeft($leftPart, $keyShiftTable[$i]);
        $rightPart = shiftLeft($rightPart, $keyShiftTable[$i]);
        $combinedParts = array_merge($leftPart, $rightPart);
        $iterationKeys[] = permuteArrays($combinedParts, $keyCompressionTable, 48);
    }

    return $iterationKeys;
}

function des(array $plainTextBits, array $iterationKeys): array
{
    global $sBox, $sBoxPermutationTable, $finalPermutationTable, $initialPermutationTable, $expansionPermutationTable;

    $plainTextBits = permuteArrays($plainTextBits, $initialPermutationTable, 64);

    $leftPart = array_slice($plainTextBits, 0, 32);
    $rightPart = array_slice($plainTextBits, 32, 32);

    for ($i = 0; $i < 16; $i++) {
        $iterationKeyBits = $iterationKeys[$i];

        $expandedRightPart = permuteArrays($rightPart, $expansionPermutationTable, 48);
        $xorRightPartWithIterationKey = xorArrays($expandedRightPart, $iterationKeyBits);

        $sBoxTransformations = [];
        for ($j = 0; $j < 8; $j++) {
            $row = base_convert(
                num: $xorRightPartWithIterationKey[$j * 6] . $xorRightPartWithIterationKey[($j * 6) + 5],
                from_base: 2,
                to_base: 10
            );
            $column = base_convert(
                num: $xorRightPartWithIterationKey[($j * 6) + 1]
                . $xorRightPartWithIterationKey[($j * 6) + 2]
                . $xorRightPartWithIterationKey[($j * 6) + 3]
                . $xorRightPartWithIterationKey[($j * 6) + 4],
                from_base: 2,
                to_base: 10
            );

            $s = base_convert(
                num: (string) $sBox[$j][$row][$column],
                from_base: 10,
                to_base: 2
            );
            $sBits = str_split($s);
            $sBoxTransformations[] = array_pad($sBits, -4, 0);
        }

        $sBoxTransformations = array_merge(...$sBoxTransformations);
        $sBoxTransformationPermuted = permuteArrays($sBoxTransformations, $sBoxPermutationTable, 32);
        $leftPart = xorArrays($leftPart, $sBoxTransformationPermuted);

        if ($i !== 15) {
            [$leftPart, $rightPart] = [$rightPart, $leftPart];
        }
    }

    $combinedParts = array_merge($leftPart, $rightPart);

    return permuteArrays($combinedParts, $finalPermutationTable, 64);
}

function mainDes(string $plainText, string $key): void
{
    echo 'Plain Text = ' . $plainText . PHP_EOL . 'Key = ' . $key . PHP_EOL;

    $plainText = asciiToHex($plainText);
    $plainText = base_convert($plainText, 16, 2);
    $key = base_convert($key, 16, 2);

    $plainTextBits = str_split($plainText);
    $keyBits = str_split($key);

    $plainTextBits = array_map(
        callback: 'intval',
        array: array_pad($plainTextBits, -64, 0)
    );
    $keyBits = array_map(
        callback: 'intval',
        array: array_pad($keyBits, -64, 0)
    );

    $iterationKeys = getIterationKeys($keyBits);
    $resultCipherBits = des($plainTextBits, $iterationKeys);
    $resultDecryptedBits = des($resultCipherBits, array_reverse($iterationKeys));

    echo 'Result = ' . strtoupper(base_convert(implode('', $resultCipherBits), 2, 16)) . PHP_EOL;
    echo 'Decrypted Result = ' . hexToAscii(base_convert(implode('', $resultDecryptedBits), 2, 16)) . PHP_EOL;
}
