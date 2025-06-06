<?php

declare(strict_types=1);

namespace App\Tests\DigitalSignature\DigitalSignatureMD5RSA;

use App\CryptoAlgorithm\RSA\RSA;
use App\CryptoAlgorithm\RSA\RSAOptions;
use App\DigitalSignature\DigitalSignatureMD5RSA\DigitalSignatureMD5RSA;
use App\HashFunction\MD5\MD5;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;

#[TestDox('Digital Signature MD5 RSA tests')]
class DigitalSignatureMD5RSATest extends TestCase
{
    private readonly DigitalSignatureMD5RSA $digitalSignatureMD5RSA;

    #[DataProvider('digitalSignatureMD5RSASignDataProvider')]
    #[TestDox('Digital signature sign --> input value to sign = $text, RSA options p = $p, q = $q, expected sign result = $expected')]
    public function testDigitalSignatureMD5RSASign(
        int $p,
        int $q,
        string $text,
        string $expected
    ): void {
        $options = $this->digitalSignatureMD5RSA->getOptions($p, $q);

        $this->assertInstanceOf(RSAOptions::class, $options);

        $result = $this->digitalSignatureMD5RSA->sign($text, $options);

        $this->assertSame($expected, $result);
    }

    #[DataProvider('digitalSignatureMD5RSAVerifyDataProvider')]
    #[TestDox('Digital signature verify --> input value to verify = $text, current signature = $signature, RSA options p = $p, q = $q, expected verify result = $expected')]
    public function testDigitalSignatureMD5RSAVerify(
        int $p,
        int $q,
        string $text,
        string $signature,
        bool $expected
    ): void {
        $options = $this->digitalSignatureMD5RSA->getOptions($p, $q);

        $this->assertInstanceOf(RSAOptions::class, $options);

        $result = $this->digitalSignatureMD5RSA->verify($text, $signature, $options);

        $this->assertSame($expected, $result);
    }

    public static function digitalSignatureMD5RSASignDataProvider(): iterable
    {
        yield [
            'p' => 13,
            'q' => 17,
            'text' => 'e',
            'expected' => '153',
        ];
    }

    public static function digitalSignatureMD5RSAVerifyDataProvider(): iterable
    {
        yield [
            'p' => 13,
            'q' => 17,
            'text' => 'e',
            'signature' => '153',
            'expected' => true,
        ];
    }

    protected function setUp(): void
    {
        $this->digitalSignatureMD5RSA = new DigitalSignatureMD5RSA(new MD5(), new RSA());
    }
}
