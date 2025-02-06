<h1 class="text-2xl font-bold text-gray-800">Genre Details</h1>

    <div class="mt-4">
        <p class="text-gray-700"><strong>ID:</strong> {{ $genre->id }}</p>
        <p class="text-gray-700"><strong>Name:</strong> {{ $genre->genre_name }}</p>
        <p class="text-gray-700"><strong>Created At:</strong>
            {{ $genre->created_at ? $genre->created_at->format('d M Y, H:i') : 'N/A' }}
        </p>

        <p class="text-gray-700"><strong>Updated At:</strong>
            {{ $genre->updated_at ? $genre->updated_at->format('d M Y, H:i') : 'N/A' }}
        </p></div>

    <div class="mt-6">
        <a href="{{ route('genre.edit', $genre) }}"
           class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
            Edit Genre
        </a>
    </div>
