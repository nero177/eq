<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FavoritesService;
use App\Enums\OrderableType;

class FavoritesController extends Controller
{
    public function __construct(private FavoritesService $favoritesService)
    {
        $this->middleware('auth:web');
    }

    public function index(Request $request)
    {
        $favorites = auth()->user()->favorites;
        $favorites->where('item_type', OrderableType::LESSON->model())->load('favoritable.author');

        return view('cabinet.favorites', compact(['favorites']));
    }

    public function add(Request $request)
    {
        $request->validate(['id' => 'integer|required', 'type' => 'required']);
        $this->favoritesService->add($request->id, OrderableType::from($request->type));
        return redirect()->back();
    }

    public function removeAll()
    {
        $this->favoritesService->removeAll();
        return redirect()->back();
    }

    public function remove(Request $request)
    {
        $request->validate(['id' => 'integer|required']);

        $this->favoritesService->remove($request->id);
        return redirect()->back();
    }
}
