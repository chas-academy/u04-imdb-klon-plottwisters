<x-head-layout>
    <body class="bg-gray-800">
    <div class="container mx-auto mt-6">
        <x-searchbar></x-searchbar>
        <h2 class="text-white">Search results for: {{ $query }}</h2>
        @include ('layouts.movies')
        <div class="w-40 h-40 flex flex-wrap">
            
        {{-- @foreach ($movies as $movie)
            <div class="p-4 m-4">
                
                <img src="{{ $movie->image_url }}" alt="{{ $movie->title }}" class="w-40 h-40 object-cover rounded">
                <h3 class="text-white text-lg font-bold mt-2">{{ $movie->title }}</h3>
            </div>
        @endforeach --}}
    </div>

    @if ($movies->isEmpty())
        <p class="text-white text-center mt-4">No movies found.</p>
    @endif
</div>
</body>
</x-head-layout>