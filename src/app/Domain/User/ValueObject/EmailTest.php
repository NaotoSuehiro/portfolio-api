<?php

namespace Tests\Unit\Domain\User\ValueObject;

use App\Domain\User\ValueObject\Email;
use App\Exceptions\DomainException;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    //正常系
    public function testCreateInstanceEmail(): void
    {
        $email  = "test@mail.com";
        $instanceEmail = Email::create($email);
        $this->assertInstanceOf(Email::class, $instanceEmail);
        $this->assertEquals($email , $instanceEmail->value());
    }

    //異常系：空欄
    public function testCreateEmptyEmailThrowsException(): void
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('メールアドレスは空欄にできません');
        Email::create('');
    }

    //異常系：スペースのみ
    public function testCreateEmailWithWhitespaceOnly(): void
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('メールアドレスは空欄にできません');
        Email::create('   ');
    }

    //異常系:@なしの英数字
    public function testCreateLoginSpaceError(): void
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('メールアドレスの形式が正しくありません');
        Email::create('abcde');
    }

    //異常系:＠が全角
    public function testCreateLoginErrorKana(): void
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('メールアドレスの形式が正しくありません');
        Email::create('abc＠mail.com');
    }
}
