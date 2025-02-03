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
    <body class="bg-gray-800">
    <div class="container mx-auto mt-6 text-white">
        <x-searchbar></x-searchbar>
        <h2>Search results for: {{ $query }}</h2>
        <div class="w-40 h-40 flex flex-wrap">
        @foreach ($movies as $movie)
            <div class="p-4 m-4">
                
                <img src="{{ $movie->image_url }}" alt="{{ $movie->title }}" class="w-40 h-40 object-cover rounded">
                <h3 class="text-white text-lg font-bold mt-2">{{ $movie->title }}</h3>
            </div>
        @endforeach
    </div>

    @if ($movies->isEmpty())
        <p class="text-white text-center mt-4">No movies found.</p>
    @endif
</div>
</body>
