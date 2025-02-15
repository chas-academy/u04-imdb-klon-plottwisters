        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
<div class="w-3/4 lg:w-2/4 mx-auto absolute inset-0 top-16 px-8 bg-gray-200 h-fit pb-8">
    <div class="mt-8 flex place-content-between">
        <img class ="w-[100px] h-[150px]" src="{{$movie->image_url}}" alt="">
        <a href="{{ route('movies.show', $movie->id) }}">X</a>
    </div>
        <form class="flex flex-col gap-4" action="@if (request()->has('reviewEdit')) {{ route('review.update', ['id' => $review->id]) }} @else {{ route('reviews', $movie->id)}} @endif" method="POST">
            @csrf
            
            @if (request()->has('reviewEdit')) 
                @method('PUT')
            @endif

            <label>Title:</label>
            <input type="hidden" name="movie_id" value="{{$movie->id}}">
            @if (request()->has('reviewEdit'))
            <input type="hidden" name="id" value="{{$review->id}}">
            @endif
            <input type="text" value="@if (request()->has('reviewEdit')) {{ $review->title }} @endif" required name="title">
            <label>Description</label>
            <textarea rows="15" required name="description">
                @if (request()->has('reviewEdit'))
                {{ $review->description }}
                @endif
            </textarea>
            <button class="btn btn-info bg-[#20C8A6] text-center rounded-md font-bold w-1/3 mx-auto" type="submit">Save</button>
        </form>
        {{-- hassle with with back route should be --}}
        {{-- @if (request()->has('reviewEdit'))
            <form class="flex flex-col gap-4 pb-20" action="{{ route('review.destroy', [$review->id, 'delete'])}}" method="POST">
                @csrf
                @method ('DELETE')
                <input type="hidden" name="movie_id" value="{{$movie->id}}">
                <button class="btn btn-info bg-[#F15C5F] text-center rounded-md font-bold w-1/3 mx-auto mt-4" type="submit" 
                    onclick="return confirm('Are you sure you want to delete this review?')">
                    Delete
                </button>
            </form>
        @endif --}}
</div>