<?php

namespace App\Http\Controllers;

use App\Enums\LessonType;
use Illuminate\Http\Request;
use App\Models\Collection;
use App\Models\Lesson;
use App\Models\User;

class CollectionController extends Controller
{
    public function show(Request $request, string $slug)
    {
        $collection = Collection::where([['slug', $slug], ['unique_template', false]])->firstOrFail();

        return view('collection', compact(['collection']));
    }

    public function fundamentalTheory(Request $request){
        $collection = Collection::where('slug', 'fundamental-theory')->firstOrFail();

        return view('fundamental', compact(['collection']));
    }

    public function masterClasses(Request $request){
        $collection = Collection::where('slug', 'master-classes')->firstOrFail();

        return view('master-classes', compact(['collection']));
    }

    public function videocourse(Request $request){
        $collection = Collection::where('slug', 'videocourses')->firstOrFail();
        $teachers = User::where('role', User::ROLE_AUTHOR)->take(2)->get();

        return view('videocourse', compact(['collection', 'teachers']));
    }
}
