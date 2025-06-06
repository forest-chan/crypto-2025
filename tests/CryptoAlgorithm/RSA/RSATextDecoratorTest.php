<?php

declare(strict_types=1);

namespace App\Tests\CryptoAlgorithm\RSA;

use App\CryptoAlgorithm\RSA\RSA;
use App\CryptoAlgorithm\RSA\RSAOptions;
use App\CryptoAlgorithm\RSA\RSATextDecorator;
use JsonException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;

#[TestDox('RSA text decorator crypto algorithm tests')]
class RSATextDecoratorTest extends TestCase
{
    private readonly RSATextDecorator $rsa;

    #[DataProvider('RSAGetOptionsDataProvider')]
    #[TestDox('RSA text decorator get options --> p = $p, q = $q, n = $expectedN, public key = $expectedPublicKey, private key = $expectedPrivateKey')]
    public function testGetOptions(
        int $p,
        int $q,
        string $expectedN,
        string $expectedPublicKey,
        string $expectedPrivateKey
    ): void {
        $options = $this->rsa->getOptions($p, $q);

        $this->assertInstanceOf(RSAOptions::class, $options);
        $this->assertSame($expectedN, $options->getN());
        $this->assertSame($expectedPublicKey, $options->getPublicKey());
        $this->assertSame($expectedPrivateKey, $options->getPrivateKey());
    }

    #[DataProvider('RSAEncryptDataProvider')]
    #[TestDox('RSA text decorator encrypt --> p = $p, q = $q, input value to encrypt = $text, expected encrypted result = $expectedStringOutput')]
    public function testRSAEncrypt(
        int $p,
        int $q,
        string $text,
        array $expected,
        string $expectedStringOutput
    ): void {
        $options = $this->rsa->getOptions($p, $q);
        $result = $this->rsa->encrypt($text, $options);

        $this->assertSame($expected, $result);
    }

    #[DataProvider('RSADecryptDataProvider')]
    #[TestDox('RSA text decorator decrypt --> p = $p, q = $q, input value to decrypt = $encryptedStringOutput, expected decrypted result = $expected')]
    public function testRSADecrypt(
        int $p,
        int $q,
        string $expected,
        array $encrypted,
        string $encryptedStringOutput
    ): void {
        $options = $this->rsa->getOptions($p, $q);
        $result = $this->rsa->decrypt($encrypted, $options);

        $this->assertSame($expected, $result);
    }

    public static function RSAGetOptionsDataProvider(): iterable
    {
        yield [
            'p' => 13,
            'q' => 17,
            'expectedN' => '221',
            'expectedPublicKey' => '5',
            'expectedPrivateKey' => '77',
        ];
        yield [
            'p' => 19,
            'q' => 23,
            'expectedN' => '437',
            'expectedPublicKey' => '5',
            'expectedPrivateKey' => '317',
        ];
    }

    /**
     * @throws JsonException
     */
    public static function RSAEncryptDataProvider(): iterable
    {
        $expectedEncrypted = ['117', '186', '75', '75', '76'];
        yield [
            'p' => 13,
            'q' => 17,
            'text' => 'hello',
            'expected' => $expectedEncrypted,
            'expectedStringOutput' => json_encode($expectedEncrypted, JSON_THROW_ON_ERROR),
        ];

        $expectedEncrypted = ['104', '80', '114', '52', '85'];
        yield [
            'p' => 19,
            'q' => 23,
            'text' => 'world',
            'expected' => $expectedEncrypted,
            'expectedStringOutput' => json_encode($expectedEncrypted, JSON_THROW_ON_ERROR),
        ];
    }

    /**
     * @throws JsonException
     */
    public static function RSADecryptDataProvider(): iterable
    {
        $expectedEncrypted = ['117', '186', '75', '75', '76'];
        yield [
            'p' => 13,
            'q' => 17,
            'expected' => 'hello',
            'encrypted' => $expectedEncrypted,
            'encryptedStringOutput' => json_encode($expectedEncrypted, JSON_THROW_ON_ERROR),
        ];

        $expectedEncrypted = ['104', '80', '114', '52', '85'];
        yield [
            'p' => 19,
            'q' => 23,
            'expected' => 'world',
            'encrypted' => $expectedEncrypted,
            'encryptedStringOutput' => json_encode($expectedEncrypted, JSON_THROW_ON_ERROR),
        ];
    }

    protected function setUp(): void
    {
        $this->rsa = new RSATextDecorator(new RSA());
    }
}
