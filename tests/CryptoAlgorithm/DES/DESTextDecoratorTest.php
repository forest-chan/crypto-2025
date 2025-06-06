<?php

declare(strict_types=1);

namespace App\Tests\CryptoAlgorithm\DES;

use App\CryptoAlgorithm\DES\DES;
use App\CryptoAlgorithm\DES\DESTextDecorator;
use JsonException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;

#[TestDox('DES text decorator crypto algorithm tests')]
class DESTextDecoratorTest extends TestCase
{
    private readonly DESTextDecorator $des;

    #[DataProvider('DESEncryptDataProvider')]
    #[TestDox('DES text decorator encrypt --> input value to encrypt = $text, key = $key, expected encrypted result = $expectedStringOutput')]
    public function testDESEncrypt(
        string $text,
        string $key,
        array $expected,
        string $expectedStringOutput
    ): void {
        $options = $this->des->getOptions($key);
        $result = $this->des->encrypt($text, $options);

        $this->assertSame($expected, $result);
    }

    #[DataProvider('DESDecryptDataProvider')]
    #[TestDox('DES text decorator decrypt --> input value to decrypt = $encryptedStringOutput, key = $key, expected decrypted result = $expected')]
    public function testDESDecrypt(
        string $key,
        string $expected,
        array $encrypted,
        string $encryptedStringOutput
    ): void {
        $options = $this->des->getOptions($key);
        $result = $this->des->decrypt($encrypted, $options);

        $this->assertSame($expected, $result);
    }

    /**
     * @throws JsonException
     */
    public static function DESEncryptDataProvider(): iterable
    {
        $expectedEncrypted = [1, 0, 1, 0, 0, 1, 1, 0, 1, 0, 0, 1, 0, 1, 0, 1, 0, 1, 1, 1, 0, 0, 1, 0, 0, 1, 1, 0, 1, 1, 1, 1, 0, 1, 1, 0, 0, 0, 1, 0, 1, 0, 1, 1, 0, 0, 0, 1, 0, 1, 0, 1, 1, 0, 1, 0, 1, 1, 0, 1, 0, 0, 1, 0];
        yield [
            'text' => 'hello',
            'key' => '133457799BBCDFF1',
            'expected' => $expectedEncrypted,
            'expectedStringOutput' => json_encode($expectedEncrypted, JSON_THROW_ON_ERROR),
        ];

        $expectedEncrypted = [0, 0, 0, 0, 1, 0, 0, 1, 0, 0, 0, 1, 1, 0, 1, 1, 0, 1, 0, 1, 1, 1, 1, 1, 1, 0, 1, 1, 0, 0, 1, 1, 0, 0, 0, 1, 0, 1, 0, 1, 0, 1, 1, 0, 1, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 1, 1, 0, 1, 0, 0, 0, 0, 1];
        yield [
            'text' => 'world',
            'key' => '0F1571C947D9E859',
            'expected' => $expectedEncrypted,
            'expectedStringOutput' => json_encode($expectedEncrypted, JSON_THROW_ON_ERROR),
        ];
    }

    /**
     * @throws JsonException
     */
    public static function DESDecryptDataProvider(): iterable
    {
        $expectedEncrypted = [1, 0, 1, 0, 0, 1, 1, 0, 1, 0, 0, 1, 0, 1, 0, 1, 0, 1, 1, 1, 0, 0, 1, 0, 0, 1, 1, 0, 1, 1, 1, 1, 0, 1, 1, 0, 0, 0, 1, 0, 1, 0, 1, 1, 0, 0, 0, 1, 0, 1, 0, 1, 1, 0, 1, 0, 1, 1, 0, 1, 0, 0, 1, 0];
        yield [
            'key' => '133457799BBCDFF1',
            'expected' => 'hello',
            'encrypted' => $expectedEncrypted,
            'encryptedStringOutput' => json_encode($expectedEncrypted, JSON_THROW_ON_ERROR),
        ];

        $expectedEncrypted = [0, 0, 0, 0, 1, 0, 0, 1, 0, 0, 0, 1, 1, 0, 1, 1, 0, 1, 0, 1, 1, 1, 1, 1, 1, 0, 1, 1, 0, 0, 1, 1, 0, 0, 0, 1, 0, 1, 0, 1, 0, 1, 1, 0, 1, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 1, 1, 0, 1, 0, 0, 0, 0, 1];
        yield [
            'key' => '0F1571C947D9E859',
            'expected' => 'world',
            'encrypted' => $expectedEncrypted,
            'encryptedStringOutput' => json_encode($expectedEncrypted, JSON_THROW_ON_ERROR),
        ];
    }

    protected function setUp(): void
    {
        $this->des = new DESTextDecorator(new DES());
    }
}
