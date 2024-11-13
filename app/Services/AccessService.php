<?php

namespace App\Services;

use App\Enums\OrderStatus;
use App\Models\Subscription;
use App\Enums\LessonType;
use App\Enums\OrderableType;
use App\Models\Orderable;
use App\Models\Lesson;
use App\Models\Collection;

class AccessService
{
    public function syncSubscriptionAccesses(Subscription $subscription, array $accesses) : bool
    {
        $accesses = [];

        foreach (request()->access as $accessItem) {
            if ($accessItem) {
                $accesses[] = ['type' => $accessItem, 'subscription_id' => $subscription->id];
            }
        }

        $subscription->access()->delete();
        $subscription->access()->createMany($accesses);

        return true;
    }

    public static function userHasSubscriptionAccess(LessonType $type) : bool
    {
        $user = auth()->user();

        if (! $user) {
            return false;
        }

        $accesses = $user->subscriptions()
            ->get()
            ->pluck('orderable.access')
            ->flatten();

        if ($accesses->where('type', $type->value)->count()) {
            return true;
        }

        return false;
    }

    public static function userHasCollectionAccess(int $lessonId, LessonType $type) : bool
    {
        $user = auth()->user();

        if (! $user) {
            return false;
        }

        $lesson = $user->collections()
            ->get()
            ->pluck('orderable.lessons')
            ->flatten()
            ->where('id', $lessonId)
            ->where('type', $type->value);

        if ($lesson->count()) {
            return true;
        }

        return false;
    }

    public static function userHasAllCollectionLessons(int $collectionId) : bool
    {
        $user = auth()->user();

        if (! $user) {
            return false;
        }

        $collection = Collection::find($collectionId);

        // $userLessons = collect($user->lessons()->get()->pluck('orderable.id')->all());
        $collectionLessons = collect($collection->lessons()->get()->pluck('id')->all());
        $userHasAccess = true;

        foreach ($collectionLessons as $lesson) {
            if(!self::hasLessonAccess($lesson, LessonType::from($collection->type))){
                $userHasAccess = false;
            }
        }

        return $userHasAccess;

        // return $collectionLessons->diff($userLessons)->isEmpty();
    }

    public static function hasLessonAccess($id, LessonType $type) : bool
    {
        if (Lesson::findOrFail($id)->is_free) {
            return true;
        }

        $hasAccess = self::userHasSubscriptionAccess($type) ||
            self::userHasCollectionAccess($id, $type) ||
            self::isPurchased($id, OrderableType::LESSON);

        return $hasAccess;
    }

    public static function isPurchased(int $id, OrderableType $type) : bool
    {
        $user = auth()->user();

        if (! $user) {
            return false;
        }

        $orderable =
            Orderable::where([['user_id', $user->id], ['orderable_id', $id], ['orderable_type', $type->model()]])
                ->whereHas('order', function ($query) {
                    $query->where('status', OrderStatus::APPROVED->value);
                });

        if ($orderable->exists()) {
            return true;
        }

        return false;
    }
}
