<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>PlotTwisters</title>

        <link rel="shortcut icon" type="image/x-icon" href="resources\css\icon\PT.svg">

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
            <h2 class="text-white font-bold text-3xl">Featured movie</h2>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/LNlrGhBpYjc?si=2eNr-AiXiSOwc5xG" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            <div class="flex w-full justify-end gap-4 mt-4">
                @if (Auth::check() && Auth::user()->name == 'admin')
                    <x-primary-a :href="route('home', 'editfeat')" :active="request()->routeIs('edit.trailer')">
                        {{ __('Edit featured movie') }}
                    </x-primary-a>
                    <x-primary-a :href="route('home', 'addmovie')" :active="request()->routeIs('movies.create')">
                        {{ __('Add movie') }}
                    </x-primary-a>
                    @if (request()->has('addmovie'))
                      @include ('layouts.addmovie')
                    @endif
                    @if (request()->has('editfeat'))
                      @include ('layouts.edit-trailer')
                    @endif
                @endif
            </div>
        </div>
        <div class="bg-[#F15C5F] items-center justify-center flex rounded-md w-2/3 mx-auto">
            @if($errors->addmovie)
            <p>{{$errors->addmovie->first()}}</p>
            @endif
       </div>
        <div class="w-2/3 mx-auto mb-8">
            <form action="{{ route('home') }}" method="GET">
                    <select class="rounded-md" name="genre" onchange="this.form.submit()">
                        <option value="">All Genres</option>

                        @foreach ($genres as $genre)
                            <option value="{{ $genre->id }}" {{ request('genre') == $genre->id ? 'selected' : '' }}>
                                {{ $genre->genre_name }}
                            </option>
                        @endforeach
                    </select>
                </form>
        </div>
        @include ('layouts.movies')


        {{ $movies->links() }}
    </body>
