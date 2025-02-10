
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
<div class="w-2/4 mx-auto absolute inset-0 top-20 px-8 bg-gray-200 h-fit pb-8">
    <a class="float-right p-4 " href="{{ route('home') }}">X</a>
        <form class="flex flex-col gap-2 mt-4 p-8 pl-12" action="{{ route('movies.store')}}" method="POST">
            @csrf
            <label>Movie trailer url:</label>
            <input type="text" placeholder="{{--@if ($request->submit == 'editMovie') {{ $movie->image_url }} @endif--}}" name="trailer_url">
            <label>Movie image url:</label>
            <input type="text" placeholder="{{--@if ($request->submit == 'editMovie') {{ $movie->trailer_url }} @endif--}}"name="image_url">
            <label>Title:</label>
            <input type="text" name="title" placeholder="{{--@if ($request->submit == 'editMovie') {{ $movie->title }} @endif--}}" required>
            <label>Director name:</label>
            <input type="text" placeholder="{{--@if ($request->submit == 'editMovie') {{ $movie->director_name }} @endif--}}" name="director_name" required>
            <label>Description</label>
            <textarea rows="15" name="description" required>
                {{-- @if ($request->submit == 'editMovie')
                {{ $movie->description }}
                @endif --}}
            </textarea>
            {{-- @if ($request->submit == 'editMovie')
                <button class="btn btn-info bg-[#F15C5F] text-center rounded-md font-bold w-1/3 mx-auto mt-8" type="submit" value="delete">Delete</button>
            @endif --}}
            <button class="btn btn-info bg-[#20C8A6] text-center rounded-md font-bold w-1/3 mx-auto mt-8" type="submit">Save</button>

        </form>
    </div>
</div>
