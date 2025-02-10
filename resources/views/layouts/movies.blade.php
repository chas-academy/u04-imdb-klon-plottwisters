<div class="flex flex-row flex-wrap w-2/3 mx-auto gap-8">
    @foreach ($movies as $movie)
        <div class="flex flex-col flex-1 items-center gap-2">
            {{-- <p>{{ $movie['title'] }}</p> --}}
            <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-info">
                <img class="w-[100px] h-[150px]" src="{{ $movie->image_url}}" alt="">
            </a>
            {{-- Add function for rating --}}
            <div class="flex flex-row items-center gap-2">
                <img src="{{ Storage::url('images/star.png')}}" alt="">
                <p class="text-[#A693FF]">3.1</p>
            </div>
            {{-- Route to store into watchlist, right now it's set to home because missing controller for watchlist --}}

            <a class="inline-flex items-center w-xl px-3 py-2 bg-teal-700 border border-transparent rounded-xl font-semibold text-xs text-black uppercase w-[150px]" href="{{ route('movies.edit', $movie->id) }}" class="btn btn-warning ">add to watchlist</a>

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
</div>
