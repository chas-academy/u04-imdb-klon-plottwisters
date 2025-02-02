<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
<body>
    @include ('layouts.navigation')
    @foreach ($movies as $movie)
        <p>{{ $movie['title'] }}</p>
        <img src="{{ $movie->image_url}}" alt="">
        <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-info">View</a>

        @if (Auth::check() && Auth::user()->name == 'admin')
        <a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-warning">Edit</a>

        <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this movie?')">Delete</button>
        </form>
        @endif
    @endforeach
    @if (Auth::check() && Auth::user()->name == 'admin')
    <a href="{{ route('movies.create') }}" class="btn btn-primary">Add Movie</a>
    @endif
</body>
