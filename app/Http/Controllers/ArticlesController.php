<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Enums\ArticleType;
use App\Models\Option;
use App\Models\Subscription;

class ArticlesController extends Controller
{
    public function index()
    {
        $popularArticles = Article::where('type', ArticleType::POPULAR)->orderBy('order')->take(2)->get();
        $bigArticle = Article::where('type', ArticleType::BIG)->first();
        $middleArticle = Article::where('type', ArticleType::MIDDLE)->first();
        $lastArticles = Article::where('type', ArticleType::DEFAULT )->latest()->get()->chunk(20);

        $options = Option::get()->pluck('value', 'key');
        $startSectionSubscription = Subscription::where('id', $options['start_section_subscription'])->first();
        $showIndex = request()->showIndex ?? 1;

        return view('blog.index', compact(['popularArticles', 'bigArticle', 'middleArticle', 'lastArticles', 'options', 'startSectionSubscription', 'showIndex']));
    }

    public function show(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        return view('blog.show', compact('article'));
    }
}
