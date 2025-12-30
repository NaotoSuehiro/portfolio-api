<?php

namespace Tests\Unit\Domain\User\ValueObject;

use App\Domain\User\ValueObject\UserPassword;
use App\Exceptions\DomainException;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserPasswordTest extends TestCase
{
    //正常系 大文字・小文字
    public function testCreateInstanceUserPasswordSucsess(): void
    {
        $userPassword  = "Password123456";
        $instance_userPassword = UserPassword::create($user_password);
        $this->assertInstanceOf(UserPassword::class, $instanceUserPassword);
        $this->assertTrue(Hash::check($user_password, $instanceUserPassword->value()));
    }

    //小文字・記号
    public function testCreateInstanceUserPasswordSucsess2(): void
    {
        $userPassword  = "test@mail.com";
        $instance_userPassword = UserPassword::create($user_password);
        $this->assertInstanceOf(UserPassword::class, $instanceUserPassword);
        $this->assertTrue(Hash::check($user_password, $instanceUserPassword->value()));
    }

    //異常系：スペースのみ
    public function testCreateUserPasswordUnder8(): void
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('パスワードは8文字以上で入力してください');
        UserPassword::create('abc');
    }

    public function testCreateUserPasswordWithWhitespaceOnly(): void
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('パスワードは8文字以上で入力してください');
        UserPassword::create('');
    }

    //異常系：空欄
    public function testCreateEmptyUserPasswordThrowsException(): void
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('パスワードは半角英数字・記号のみ使用可能です');
        UserPassword::create('                   ');
    }

    //異常系:文字の間に空白
    public function testCreateUserPasswordErrorSpace(): void
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('パスワードは半角英数字・記号のみ使用可能です');
        UserPassword::create('abc abc abc abc');
    }

    //異常系:ひらがな
    public function testCreateUserPasswordErrorKana(): void
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('パスワードは半角英数字・記号のみ使用可能です');
        UserPassword::create('あいうえおかきくけこさしすせそ');
    }

    //異常系:英単語とひらがな
    public function testCreateUserPasswordErrorMix(): void
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('パスワードは半角英数字・記号のみ使用可能です');
        UserPassword::create('aあbcdefghijk');
    }
}
