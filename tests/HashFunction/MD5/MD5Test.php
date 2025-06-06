<?php

declare(strict_types=1);

namespace App\Tests\HashFunction\MD5;

use App\HashFunction\MD5\MD5;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;

#[TestDox('MD5 hash function tests')]
class MD5Test extends TestCase
{
    private readonly MD5 $md5;

    #[DataProvider('MD5dataProvider')]
    #[TestDox('MD5 hashing --> input value to hash = $text, expected hash = $expected')]
    public function testMD5(string $text, string $expected): void
    {
        $result = $this->md5->hash($text);

        $this->assertSame($expected, $result);
    }

    public static function MD5dataProvider(): iterable
    {
        yield [
            'text' => 'hello',
            'expected' => '5d41402abc4b2a76b9719d911017c592',
        ];
        yield [
            'text' => 'world',
            'expected' => '7d793037a0760186574b0282f2f435e7',
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->md5 = new MD5();
    }
}
