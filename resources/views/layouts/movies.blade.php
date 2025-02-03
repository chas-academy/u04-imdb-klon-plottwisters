<div class="flex flex-row flex-wrap w-2/3 mx-auto">
    @foreach ($movies as $movie)

            <div class="flex flex-col flex-1 items-center m-4">
                {{-- <p>{{ $movie['title'] }}</p> --}}
                <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-info"><img src="{{ $movie->image_url}}" alt=""></a>
                {{-- Add function for rating --}}
                <img src="{{ Storage::url('images/star.png')}}" alt=""><p class="text-[#A693FF]">3.1</p>
                {{-- Route to store into watchlist, right now its set to home because missing controller for watchlist --}}
                <a href="{{ route('home', $movie->id) }}" class="btn btn-info bg-[#20C8A6] w-40 text-center rounded-md font-bold">Add to watchlist</a>
            
            {{-- @if (Auth::check() && Auth::user()->name == 'admin')
            <a class="text-white" href="{{ route('movies.edit', $movie->id) }}" class="btn btn-warning">Edit</a>

            <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button class="text-white" type="submit" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this movie?')">Delete</button>
            </form>
            @endif --}}
        </div>

    @endforeach