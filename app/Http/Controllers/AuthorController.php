<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Lesson;
use App\Enums\LessonType;

class AuthorController extends Controller
{
    public function show(Request $request, $slug)
    {
        $author = User::where([['details->slug', $slug],['role', User::ROLE_AUTHOR]])->first();

        $masterClasses = Lesson::where([['author_id', $author->id], ['type', LessonType::MASTER_CLASS->value]])->get();

        return view('author', compact(['masterClasses', 'author']));
    }
}
