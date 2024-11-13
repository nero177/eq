<?php

namespace App\Services;

use App\Enums\OrderableType;
use App\Models\Collection;
use App\Models\Lesson;
use App\Enums\LessonType;

class LessonService
{
    public function __construct(private AccessService $accessService)
    {
    }

    public function getLessonsByType(LessonType $type)
    {
        if (AccessService::userHasSubscriptionAccess($type)) {
            return Lesson::where('type', $type->value)->with('author')->orderBy('order')->get();
        }

        $collectionLessons = $this->getUserCollectionLessonsByType($type);
        $lessons = $this->getUserLessonsByType($type);

        if ($collectionLessons->count()) {
            return $collectionLessons->merge($lessons)->unique('id');
        }

        if ($lessons && $lessons->count()) {
            return $lessons;
        }

        return null;
    }

    public function newForms()
    {
        // $masterClasses = $this->getLessonsByType(LessonType::MASTER_CLASS);

        // if (! $masterClasses) {
        //     return null;
        // }

        $lessons = Lesson::where([['is_new', true], ['type', LessonType::MASTER_CLASS->value]])->get();

        if (! $lessons) {
            return null;
        }

        return $lessons;
    }

    public function getLesson(int $id)
    {
        $lesson = Lesson::with('author')->find($id);

        if (AccessService::hasLessonAccess($id, LessonType::from($lesson->type))) {
            return $lesson;
        }

        return null;
    }

    public function getUserCollectionLessonsByType(LessonType $type)
    {
        $user = auth()->user();

        $collectionLessons = $user->collections()
            ->get()
            ->pluck('orderable.lessons')
            ->flatten()
            ->where('type', $type->value);

        return $collectionLessons;
    }

    public function getUserCollectionLessonsBySlug($slug)
    {
        $user = auth()->user();

        $collection = $user->collections()->get()
            ->pluck('orderable')
            ->flatten()
            ->where('slug', $slug);

        if (! $collection->isEmpty()) {
            $lessons = $collection->pluck('lessons')->flatten();
            return $lessons;
        }

        $collection = Collection::where('slug', $slug)->firstOrFail();

        if (AccessService::userHasAllCollectionLessons($collection->id)) {
            $lessons = $collection->lessons()->get();
            return $lessons;
        }

        return null;
    }

    public function getUserLessonsByType(LessonType $type)
    {
        $user = auth()->user();
        $lessons = $user->lessons();

        if($lessons->get()->isEmpty()){
            return null;
        }

        $lessons = $lessons->get()->pluck('orderable')->where('type', $type->value)->sortBy('order');
        return $lessons;
    }
}