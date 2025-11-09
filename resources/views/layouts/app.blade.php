<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Entertainments')</title>

    {{-- This loads your compiled CSS and JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">

    <nav class="flex justify-between items-center p-4 bg-gray-100 dark:bg-gray-900 dark:text-white">
        <a href="/" class="font-bold text-xl">🎬 Entertainment App</a>

        <div>
            @auth
                <span class="mr-3">Hi, {{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-red-500 hover:underline">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-blue-500 hover:underline mr-3">Login</a>
                <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Register</a>
            @endauth
        </div>
    </nav>
    <main class="max-w-6xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        @yield('content')
    </main>
</body>
</html>
