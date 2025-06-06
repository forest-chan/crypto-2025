<?php

declare(strict_types=1);

namespace App\Tests\CryptoAlgorithm\RSA;

use App\CryptoAlgorithm\RSA\RSA;
use App\CryptoAlgorithm\RSA\RSAOptions;
use JsonException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;

#[TestDox('RSA crypto algorithm tests')]
class RSATest extends TestCase
{
    private readonly RSA $rsa;

    #[DataProvider('RSAGetOptionsDataProvider')]
    #[TestDox('RSA get options --> p = $p, q = $q, n = $expectedN, public key = $expectedPublicKey, private key = $expectedPrivateKey')]
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
    #[TestDox('RSA encrypt --> p = $p, q = $q, input value to encrypt = $number, expected encrypted result = $expectedStringOutput')]
    public function testRSAEncrypt(
        int $p,
        int $q,
        string $number,
        array $expected,
        string $expectedStringOutput
    ): void {
        $options = $this->rsa->getOptions($p, $q);
        $result = $this->rsa->encrypt($number, $options);

        $this->assertSame($expected, $result);
    }

    #[DataProvider('RSADecryptDataProvider')]
    #[TestDox('RSA decrypt --> p = $p, q = $q, input value to decrypt = $encrypted, expected decrypted result = $encryptedStringOutput')]
    public function testRSADecrypt(
        int $p,
        int $q,
        array $encrypted,
        string $expected,
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

    public static function RSAEncryptDataProvider(): iterable
    {
        yield [
            'p' => 13,
            'q' => 17,
            'number' => '123',
            'expected' => ['106'],
            'expectedStringOutput' => '["106"]',
        ];
        yield [
            'p' => 19,
            'q' => 23,
            'number' => '123',
            'expected' => ['16'],
            'expectedStringOutput' => '["16"]',
        ];
    }

    public static function RSADecryptDataProvider(): iterable
    {
        yield [
            'p' => 13,
            'q' => 17,
            'encrypted' => ['106'],
            'expected' => '123',
            'encryptedStringOutput' => '["106"]',
        ];
        yield [
            'p' => 19,
            'q' => 23,
            'encrypted' => ['16'],
            'expected' => '123',
            'encryptedStringOutput' => '["16"]',
        ];
    }

    protected function setUp(): void
    {
        $this->rsa = new RSA();
    }
}
