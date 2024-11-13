<?php

namespace App\Http\Controllers;

use App\Enums\LessonType;
use App\Models\Collection;
use App\Services\LessonService;
use Illuminate\Http\Request;
use App\Models\Option;
use App\Models\Lesson;

class LessonController extends Controller
{
    public function __construct(private LessonService $lessonService, )
    {
        $this->middleware('auth:web')->except('lesson');
    }

    public function masterClasses(Request $request)
    {
        $lessons = $this->lessonService->getLessonsByType(LessonType::MASTER_CLASS);
        // if (! $lessons) {
        //     return redirect(localize_url('/master-classes'));
        // }

        return view('cabinet.courses.master_classes', compact(['lessons']));
    }

    public function videoCourses(Request $request)
    {
        //отображать если купленна подписка или коллекция
        $lessons = $this->lessonService->getLessonsByType(LessonType::VIDEOCOURSE);

        if (! $lessons) {
            return redirect(localize_url('/videocourse'));
        }

        return view('cabinet.courses.video_courses', compact(['lessons']));
    }

    public function fundamentalTheory(Request $request)
    {
        $lessons = $this->lessonService->getLessonsByType(LessonType::FUNDAMENTAL);

        if (! $lessons) {
            return redirect(localize_url('/fundamental-theory'));
        }

        return view('cabinet.courses.fundamental', compact(['lessons']));
    }

    public function adaptation(Request $request)
    {
        $lesson = Lesson::where('type', LessonType::ADAPTATION)->first();

        if (! $lesson) {
            return redirect(localize_url('/cabinet'));
        }
        
        return view('cabinet.courses.adaptation', compact('lesson'));
    }

    public function film(Request $request)
    {
        $filmUrl = Option::where('key', 'film_url')->first()->value;

        return view('cabinet.film', compact('filmUrl'));
    }

    public function lesson(Request $request, $id)
    {   
        $lesson = $this->lessonService->getLesson($id);

        if (! $lesson) {
            return redirect(localize_url('/cabinet'));
        }

        return view('cabinet.courses.show', compact(['lesson']));
    }

    public function newForms(){
        $lessons = $this->lessonService->newForms();

        if (! $lessons) {
            return redirect(localize_url('/master-classes'));
        }

        return view('cabinet.new-forms', compact(['lessons']));
    }

    public function collectionLessons($slug){
        $lessons = $this->lessonService->getUserCollectionLessonsBySlug($slug);
        $collection = Collection::firstWhere('slug', $slug);

        if (! $lessons) {
            return redirect(localize_url('/collection/' . $slug));
        }

        return view('cabinet.courses.master_classes', compact(['collection', 'lessons']));
    }
}
