        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
<div class="w-1/3 mx-auto">
    <div class="mt-8">
        <img src="{{-- {{$movie->image_url}} --}} https://posters.movieposterdb.com/22_01/2021/8721424/t_8721424_ac84bfc0.jpg" alt="">
    </div>
        <form class="flex flex-col gap-4" action="">
            <label>Title:</label>
            <input type="text" placeholder="{{--@if ($request->submit == 'edit') {{ $review->title }} @endif--}}">
            <label>Description</label>
            <textarea rows="15">
                {{-- @if ($request->submit == 'edit')
                {{ $review->description }}
                @endif --}}
            </textarea>
            {{-- @if ($request->submit == 'edit')
                <button class="btn btn-info bg-[#F15C5F] text-center rounded-md font-bold w-1/3 mx-auto mt-8" type="submit" value="delete">Delete</button>
            @endif --}}
            <button class="btn btn-info bg-[#20C8A6] text-center rounded-md font-bold w-1/3 mx-auto mt-8" type="submit" value="create">Save</button>

        </form>
    </div>
</div>