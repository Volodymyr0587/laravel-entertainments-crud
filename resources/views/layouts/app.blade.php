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

    {{--
      This is the main container that centers your content.
      - `max-w-4xl`: Sets a max width
      - `mx-auto`:  Horizontally centers the container
      - `py-12`:   Adds padding on the top and bottom
    --}}
    <div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">

        {{-- This is where your page content will be injected --}}
        @yield('content')

    </div>

</body>
</html>
