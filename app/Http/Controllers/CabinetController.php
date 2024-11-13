<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CabinetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web', ['except' => ['auth']]);
    }

    public function __invoke()
    {
        $user = auth()->user();
        return view('cabinet.index', compact('user'));
    }

    public function auth()
    {
        return view('cabinet.auth');
    }

    public function editView()
    {
        return view('cabinet.edit');
    }
}
