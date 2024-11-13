<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserEditRequest;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(private UserService $userService)
    {
        $this->middleware('auth:web');
    }

    public function edit(UserEditRequest $request){
        if($request->current_password && !$request->new_password){
            return back()->withErrors(['error' => __('auth.new_password_required')]);
        }

        if(!$request->current_password && $request->new_password){
            return back()->withErrors(['error' => __('auth.old_password_required')]);
        }

        if(!$this->userService->edit(array_filter(request()->only('name', 'surname', 'current_password', 'new_password')))){
            return back()->withErrors(['error' => __('site.error')]);
        }

        return back();
    }
}
