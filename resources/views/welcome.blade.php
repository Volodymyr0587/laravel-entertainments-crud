@extends('layouts.app')

@section('content')
<div class="text-center mt-20">
    <h1 class="text-4xl font-bold mb-6">Welcome to Entertainment App 🎬</h1>
    <p class="text-lg text-gray-600 mb-8">Manage and explore your favorite movies, series, and more.</p>

    <a href="{{ route('login') }}"
       class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 mr-2">
        Login
    </a>
    <a href="{{ route('register') }}"
       class="px-6 py-3 bg-gray-200 text-gray-800 font-semibold rounded-md hover:bg-gray-300">
        Register
    </a>
</div>
@endsection
