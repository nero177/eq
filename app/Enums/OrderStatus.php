<?php

namespace App\Enums;

enum OrderStatus : string
{
    case PROCESSING = 'processing';
    case APPROVED = 'approved';
    case DECLINED = 'declined';
    case EXPIRED = 'expired';
    case REFUNDED = 'refunded';

    public static function toArray() : array
    {
        return array_column(self::cases(), 'value');
    }

    public function alias() : string
    {
        return match ($this) {
            self::PROCESSING => __('Оброблюється'),
            self::APPROVED => __('Підтверджено'),
            self::DECLINED => __('Відхилено'),
            self::EXPIRED => __('Прострочений'),
            self::REFUNDED => __('Повернуті кошти'),
        };
    }

    public static function casesWithAliases()
    {
        $cases = [];

        foreach (self::cases() as $case) {
            $cases[$case->value] = $case->alias();
        }

        return $cases;
    }
}