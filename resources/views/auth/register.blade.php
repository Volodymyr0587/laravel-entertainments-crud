@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-4">Register</h1>

    <form method="POST" action="/register" class="space-y-4">
        @csrf

        <div>
            <label class="block mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name') }}"
                   class="w-full border rounded-md px-3 py-2">
            @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}"
                   class="w-full border rounded-md px-3 py-2">
            @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1">Password</label>
            <input type="password" name="password"
                   class="w-full border rounded-md px-3 py-2">
            @error('password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1">Confirm Password</label>
            <input type="password" name="password_confirmation"
                   class="w-full border rounded-md px-3 py-2">
        </div>

        <button type="submit"
                class="w-full bg-indigo-600 text-white rounded-md py-2 font-semibold hover:bg-indigo-700">
            Register
        </button>

        <p class="text-center text-sm mt-4">
            Already have an account?
            <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">Login</a>
        </p>
    </form>
</div>
@endsection
