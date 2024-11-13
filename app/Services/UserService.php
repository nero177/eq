<?php

namespace App\Services;

use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserService
{
    public function __construct(private AuthService $authService)
    {
    }

    public function updatePassword(string $newPassword) : bool
    {
        $user = auth()->user();

        if (! $user) {
            return false;
        }

        $user->password = $newPassword;
        $user->password_updated_at = now()->toDateTimeString();

        if ($user->save()) {
            return auth()->attempt(['email' => $user->email, 'password' => $newPassword]);
        }

        return false;
    }

    public function resetPassword(array $credentials) : string
    {
        $status = Password::reset(
            $credentials,
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
                $user->password_updated_at = now()->toDateTimeString();

                if ($user->save()) {
                    auth()->attempt(['email' => $user->email, 'password' => $password]);
                }
        
                event(new PasswordReset($user));
            }
        );

        return $status;
    }

    public function edit(array $data) : bool
    {
        $user = auth()->user();

        if ($data['name'] || $data['surname']) {
            $user->name = $data['name'];
            $user->surname = $data['surname'];
        }

        if (isset($data['current_password']) && isset($data['new_password'])) {
            if (Hash::check($data['current_password'], $user->password)) {
                $user->password = Hash::make($data['new_password']);
                $user->save();
                $this->authService->logout();
            }
        }

        if (! $user->save()) {
            return false;
        }

        return true;
    }
}