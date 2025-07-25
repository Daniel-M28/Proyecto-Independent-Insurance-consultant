<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class=" font-sans text-gray-900 ">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-zinc-900 ">

    
      
           @if (!empty($title))
    <h1 class="text-white text-4xl -mt-6">{{ $title }}</h1>
        @endif

           

            <div class="w-full sm:max-w-md px-6 py-4 bg-zinc-800 shadow-md overflow-hidden sm:rounded-lg ">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
