<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\UserRegistered;
use Illuminate\Support\Facades\URL;
use App\Services\AuthService;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService)
    {
        $this->middleware('auth:web', ['except' => ['register', 'login']]);
    }

    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();
        $tempPassword = Str::password(16);

        $user = User::create([
            'email' => $validated['email'],
            'name' => $validated['name'],
            'password' => bcrypt($tempPassword)
        ]);

        $credentials = [
            'email' => $validated['email'],
            'password' => $tempPassword
        ];

        $newPasswordUrl = URL::signedRoute('new-password');

        Mail::to($user)->queue(new UserRegistered($user, $tempPassword, $newPasswordUrl));

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('cabinet');
        }

        return redirect()->back()->withErrors(['email' => __('auth.failed')]);
    }

    public function login(LoginRequest $request)
    {
        $validated = $request->validated();
        $credentials = $request->only(['email', 'password']);

        try{
            auth()->attempt($credentials, $validated['remember_me'] ?? false);
        } catch (\Exception $e) {
            if ($e->getMessage() == 'This password does not use the Bcrypt algorithm.'){
                return redirect()->back()->withErrors(['email' => __('auth.failed')]);
            }

            return redirect()->back()->withErrors(['email' => __('auth.failed')]);
        }
      
        return redirect()->route('cabinet');
    }

    public function logout(Request $request)
    {
        $this->authService->logout();
        
        return redirect('/');
    }
}
