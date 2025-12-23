<?php

namespace Tests\Unit\Domain\User\ValueObject;

use App\Domain\User\ValueObject\LoginId;
use App\Exceptions\DomainException;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    //正常系
    public function testCreateInstanceEmail(): void
    {
        //インスタンス用テスト
        $email  = "test@mail.com";
        $instanceEmail = Email::create($email);
        $this->assertInstanceOf(Email::class, $instanceEmail);
        $this->assertEquals($email , $instanceEmail->value());
    }

    //異常系：空欄
    public function testCreateEmptyLoginIdThrowsException(): void
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('メールアドレスは空欄にできません');
        LoginId::fromString('');
    }

    //異常系：スペースのみ
    public function testCreateLoginIdWithWhitespaceOnly(): void
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('メールアドレスは空欄にできません');
        LoginId::fromString('   ');
    }

    //異常系
    public function testCreateLoginSpaceError(): void
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('メールアドレスの形式が正しくありません');
        LoginId::fromString('abcde');
    }

    //異常系:
    public function testCreateLoginErrorKana(): void
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('メールアドレスは半角英数字・記号のみ使用可能です');
        LoginId::fromString('あいうえお');
    }

    //異常系:
    public function testCreateLoginErrorMix(): void
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('メールアドレスは半角英数字・記号のみ使用可能です');
        LoginId::fromString('aあb');
    }
}
