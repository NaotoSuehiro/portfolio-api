<?php

namespace Tests\Unit\Domain\Common\ValueObject;

use App\Domain\Common\ValueObject\UUId;
use App\Exceptions\DomainException;
use PHPUnit\Framework\TestCase;
use Illuminate\Support\Str;

class UUIdTest extends TestCase
{
    public function testGenerateCreatesValidUuid(): void
    {
        $announce_id = UUId::generate();
        $this->assertTrue(Str::isUuid($announce_id->value()));
    }

    public function testFromStringWithValidUuid(): void
    {
        $valid_uuid = '123e4567-e89b-12d3-a456-426614174000';
        $announce_id = UUId::fromString($valid_uuid);
        $this->assertEquals($valid_uuid, $announce_id->value());
    }

    public function testFromStringWithInvalidUuidThrowsException(): void
    {
        $this->expectException(DomainException::class);
        UUId::fromString('invalid-uuid');
    }

    public function testValueReturnsCorrectUuid(): void
    {
        $uuid = '123e4567-e89b-12d3-a456-426614174000';
        $announce_id = UUId::fromString($uuid);
        $this->assertEquals($uuid, $announce_id->value());
    }

    public function testEquality(): void
    {
        $uuid = '123e4567-e89b-12d3-a456-426614174000';
        $announce_id1 = UUId::fromString($uuid);
        $announce_id2 = UUId::fromString($uuid);
        $this->assertTrue($announce_id1->equals($announce_id2));
    }

    public function testInequality(): void
    {
        $announce_id1 = UUId::generate();
        $announce_id2 = UUId::generate();
        $this->assertFalse($announce_id1->equals($announce_id2));
    }
}
