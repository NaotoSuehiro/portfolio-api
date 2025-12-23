<?php

namespace Tests\Unit\Domain\Common\ValueObject;

use App\Domain\Common\ValueObject\UUId;
use App\Exceptions\DomainException;
use PHPUnit\Framework\TestCase;
use Illuminate\Support\Str;

class UUIdTest extends TestCase
{
    //正常系 UUID生成
    public function testGenerateCreatesValidUuid(): void
    {
        $uuid = UUId::generate();
        $this->assertTrue(Str::isUuid($uuid->value()));
    }

    //正常系 UUID文字列からインスタンス生成
    public function testFromStringWithValidUuid(): void
    {
        $validUuid = '123e4567-e89b-12d3-a456-426614174000';
        $uuid = UUId::create($validUuid);
        $this->assertEquals($validUuid, $uuid->value());
    }

    //正常系 equalsメソッドの確認
    public function testEquality(): void
    {
        $uuid = '123e4567-e89b-12d3-a456-426614174000';
        $uuid1 = UUId::create($uuid);
        $uuid2 = UUId::create($uuid);
        $this->assertTrue($uuid1->equals($uuid2));
    }

    //正常系 等価ではないUUIDの確認
    public function testInequality(): void
    {
        $uuid1 = UUId::generate();
        $uuid2 = UUId::generate();
        $this->assertFalse($uuid1->equals($uuid2));
    }

    //異常系 無効なUUID文字列からインスタンス生成
    public function testFromStringWithInvalidUuidThrowsException(): void
    {
        $this->expectException(DomainException::class);
        UUId::create('invalid-uuid');
    }

}
