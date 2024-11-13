<?php

namespace App\Http\Controllers;

use App\Enums\LessonType;
use App\Models\Lesson;
use App\Models\Page;
use App\Models\TheoryItem;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Subscription;
use App\Models\Option;
use App\Models\User;
use Illuminate\Support\Facades\View;

class FrontController extends Controller
{
    public function index(Request $request)
    {
        $banners = Banner::take(4)->get();
        $subscriptions = Subscription::take(10)->get();
        $options = Option::get()->pluck('value', 'key');
        $startSectionSubscription = $subscriptions->where('id', $options['start_section_subscription'])->first();

        return view('pages.home', compact(['banners', 'subscriptions', 'options', 'startSectionSubscription']));
    }

    public function about(Request $request)
    {
        $teachers = User::where([['role', User::ROLE_AUTHOR], ['details->show_in_about', 1]])->orderBy('details->order')->get();
        return view('pages.about', compact(['teachers']));
    }

    public function theory(Request $request)
    {
        $theoryItems = TheoryItem::get();

        return view('pages.theory', compact('theoryItems'));
    }


    public function showPageBySlug(Request $request, string $slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        $data = [
            'title' => $page->title,
            'content' => $page->content
        ];

        if (! View::exists($page->template)) {
            return abort(404);
        }

        return view($page->template, compact('data'));
    }

    public function adaptation()
    {
        $adaptation = Lesson::where('type', LessonType::ADAPTATION->value)->firstOrFail();

        return view('pages.adaptation', compact('adaptation'));
    }

    public function paymentSuccess()
    {
        return view('order.success');
    }
}
