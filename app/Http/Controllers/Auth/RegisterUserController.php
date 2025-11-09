<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class RegisterUserController extends Controller
{
    /**
     * Show the form for creating a new user
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Store a newly created user in database
     */
    public function store(Request $request): RedirectResponse
    {
        $userAttributes = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = User::create($userAttributes);

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
