<?php

namespace App\Domain\Inquiry\ValueObject;

use App\Domain\Inquiry\Enum\InquiryStatusEnum;
use DomainException;

final class InquiryStatus
{
    private static array $labels = [
        InquiryStatusEnum::OPEN->value => '未対応',
        InquiryStatusEnum::IN_PROGRESS->value => '対応中',
        InquiryStatusEnum::CLOSED->value => '完了',
    ];

    private function __construct(
        private readonly InquiryStatusEnum $value
    ) {}

    public static function fromString(string $value): self
    {
        self::validate($value);
        return new self(InquiryStatusEnum::from($value));
    }

    public static function fromEnum(InquiryStatusEnum $value): self
    {
        return new self($value);
    }

    public static function create(string $value): self
    {
        self::validate($value);
        return new self(InquiryStatusEnum::from($value));
    }

    public static function createFromEnum(InquiryStatusEnum $value): self
    {
        return new self($value);
    }

    public static function reconstruct(string $value): self
    {
        return new self(InquiryStatusEnum::from($value));
    }

    public function value(): string
    {
        return $this->value->value;
    }

    public function enum(): InquiryStatusEnum
    {
        return $this->value;
    }

    public function label(): string
    {
        return self::$labels[$this->value->value];
    }

    private static function validate(string $value): void
    {
        if ($value === '') {
            throw new DomainException('ステータスが選択されていません。');
        }

        if (!array_key_exists($value, self::$labels)) {
            throw new DomainException('ステータスが正しくありません。');
        }
    }
}