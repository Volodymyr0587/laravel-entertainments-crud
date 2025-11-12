<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        $remember = request()->has('remember');

        if (! Auth::attempt($attributes, $remember)) {
            throw ValidationException::withMessages([
                'email'=> __("auth.failed"),
            ]);
        }

        request()->session()->regenerate();

        return redirect()->route('dashboard');
    }

    public function destroy()
    {
        Auth::logout();

        return redirect('/');
    }
}
