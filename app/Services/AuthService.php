<?php

namespace App\Services;

class AuthService
{
    public function logout(){
        auth()->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return true;
    }
}