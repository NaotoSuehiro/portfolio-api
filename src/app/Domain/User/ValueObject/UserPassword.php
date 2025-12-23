<?php

namespace App\Domain\User\ValueObject;

use App\Domain\Common\ValueObject\ValueObjectInterface;
use App\Domain\Common\ValueObject\ValueObjectTrait;
use App\Exceptions\DomainException;
use Illuminate\Support\Facades\Hash;

class UserPassword implements ValueObjectInterface
{
    use ValueObjectTrait;

    private function __construct(private readonly string $value) {}

    public function value(): string
    {
        return $this->value;
    }

    public function verify(string $rawPassword): bool
    {
        return Hash::check($rawPassword, $this->value);
    }

    public static function create(string $password): UserPassword
    {
        self::validate($password);
        return new UserPassword(self::toHash($password));
    }

    public static function reconstruct(string $password): UserPassword
    {
        return new UserPassword($password);
    }

    public static function toHash(string $password): string
    {
        return Hash::make($password);
    }

    public static function generateRandomInitialPassword(): string
    {
        $PASSWORD_LENGTH = 9;
        $headChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $password = $headChars[random_int(0, strlen($headChars) - 1)];

        $chars = $headChars . '!@#$%^&*()';
        for ($i = 0; $i < $PASSWORD_LENGTH; ++$i) {
            $password .= $chars[random_int(0, strlen($chars) - 1)];
        }
        return $password;
    }

    private static function validate(string $password): void
    {
        $PASSWORD_MIN_LENGTH = 8;
        if (strlen($password) < $PASSWORD_MIN_LENGTH) {
            throw new DomainException("パスワードは{$PASSWORD_MIN_LENGTH}文字以上で入力してください");
        }

        // 半角英数字記号のみ
        $PASSWORD_PATTERN = '/^[a-zA-Z0-9!-\/:-@¥[-`{-~]*$/';
        if (!preg_match($PASSWORD_PATTERN, $password)) {
            throw new DomainException("パスワードは半角英数字・記号のみ使用可能です");
        }
    }
}
