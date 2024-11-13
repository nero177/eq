<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\NewPasswordRequest;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\Password;

class PasswordController extends Controller
{
    public function __construct(private UserService $userService)
    {
    }

    public function newPassword(NewPasswordRequest $request)
    {
        $validated = $request->validated();

        if (! $this->userService->updatePassword($request->new_password)) {
            return redirect()->back()->withErrors(['password' => __('auth.password_update_error')]);
        }

        return redirect()->route('cabinet');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );
     
        return $status === Password::RESET_LINK_SENT
                    ? redirect(localize_url('/auth/reset-password-sended'))
                    : back()->withErrors(['email' => __($status)]);   
    }

    public function resetPassword(ResetPasswordRequest $request){
        $request->validated();
     
        $status = $this->userService->resetPassword($request->only('email', 'password', 'password_confirmation', 'token'));
     
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('cabinet')
                    : back()->withErrors(['email' => [__($status)]]);
    }
}
