<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>PlotTwisters</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
<body class="bg-[#1E1E1E]">
    @include ('layouts.navigation')
    <div class="flex flex-1 items-start w-fit m-4 flex-col mx-auto">
        <h2 class="text-white">Featured</h2>
        <iframe width="560" height="315" src="https://www.youtube.com/embed/LNlrGhBpYjc?si=2eNr-AiXiSOwc5xG" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
    </div>
    <div class="flex flex-row flex-wrap w-2/3 mx-auto">
        @foreach ($movies as $movie)

                <div class="flex flex-col flex-1 items-center m-4">
                    {{-- <p>{{ $movie['title'] }}</p> --}}
                    <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-info"><img src="{{ $movie->image_url}}" alt=""></a>
                    {{-- Route to store into watchlist, right now its set to home because missing controller for watchlist --}}
                    <a href="{{ route('home', $movie->id) }}" class="btn btn-info bg-[#20C8A6] w-40 text-center rounded-md">Add to watchlist</a>
                </div>
                @if (Auth::check() && Auth::user()->name == 'admin')
                <a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-warning">Edit</a>

                <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this movie?')">Delete</button>
                </form>
                @endif
        

        @endforeach
    </div>
    @if (Auth::check() && Auth::user()->name == 'admin')

        <a href="{{ route('movies.create') }}" class="btn btn-primary">Add Movie</a>

    @endif
    {{ $movies->links() }}
</body>
