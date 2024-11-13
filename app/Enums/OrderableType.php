<?php

namespace App\Enums;

enum OrderableType: string
{
    case SUBSCRIPTION = 'subscription';
    case LESSON = 'lesson';
    case COLLECTION = 'collection';

    public function model() : string
    {
        return match ($this) {
            self::SUBSCRIPTION => 'App\Models\Subscription',
            self::LESSON => 'App\Models\Lesson',
            self::COLLECTION => 'App\Models\Collection',
        };
    }
}