<?php

namespace App\Enums;

enum ArticleType: string
{
    case POPULAR = 'popular';
    case BIG = 'big';
    case MIDDLE = 'middle';
    case DEFAULT = 'default';

    public function alias() : string
    {
        return match ($this) {
            self::POPULAR => __('Popular'),
            self::BIG => __('Is big'),
            self::MIDDLE => __('Is middle sized'),
            self::DEFAULT => __('Default'),
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
