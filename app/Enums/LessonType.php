<?php

namespace App\Enums;

enum LessonType: string
{
    case MASTER_CLASS = 'master_class';
    case VIDEOCOURSE = 'videocourse';
    case ADAPTATION = 'adaptation';
    case FUNDAMENTAL = 'fundamental';

    public function alias() : string
    {
        return match ($this) {
            self::MASTER_CLASS => __('Master-classes'),
            self::VIDEOCOURSE => __('Videcourses'),
            self::ADAPTATION => __('Adaptation'),
            self::FUNDAMENTAL => __('Fundamental'),
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
