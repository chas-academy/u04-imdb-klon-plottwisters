
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
<div class="w-3/4 mx-auto absolute inset-0 top-20 bg-gray-200 h-fit pb-8">
    <a class="float-right p-4 " href="{{ route('home') }}">X</a>
    <form class="flex flex-col gap-2 mt-4 pl-12" action="@if (request()->has('edit')) {{ route('movies.update', $movie->id) }} @else {{ route('movies.store')}} @endif" method="POST">
        @csrf
        @if (request()->has('edit'))
        @method('PUT')
        @endif
        <label>Movie trailer url:</label>
        <input type="text" value="@if (request()->has('edit')) {{ $movie->trailer_url }} @endif" name="trailer_url">
        <label>Movie image url:</label>
        <input type="text" value="@if (request()->has('edit')) {{ $movie->image_url }} @endif"name="image_url">
        <label>Title:</label>
        <input type="text" name="title" value="@if (request()->has('edit')) {{ $movie->title }} @endif" required>
        <label>Director name:</label>
        <input type="text" value="@if (request()->has('edit')) {{ $movie->director_name }} @endif" name="director_name" required>
        <label>Description</label>
        <textarea rows="15" name="description" required>@if (request()->has('edit')) {{ $movie->description }} @endif </textarea>
        <x-primary-button class=" w-1/4 mx-auto justify-center" type="submit">Save</x-primary-button>
    </form>
    @if (request()->has('edit'))
        <form class="flex justify-center pb-20" action="{{ route('movies.destroy', [$movie->id, 'delete'])}}" method="POST">
            @csrf
            @method ('DELETE')
            <x-delete-button class="w-1/5 mx-auto mt-4 justify-center" type="submit" value="delete">Delete</x-delete-button>
        </form>
    @endif  
</div>
