
<div class="max-w-4xl mx-auto mt-10 p-6 bg-white shadow-lg rounded-lg">
    <h1 class="text-2xl font-bold text-gray-800">Genres List</h1>

    <div class="mt-6">
        @foreach ($genres as $genre)
            <div class="flex justify-between items-center bg-gray-100 p-4 rounded-lg mb-3">
                <h2 class="text-lg font-semibold text-gray-700">
                    {{ $genre->id }} - {{ $genre->genre_name }}
                </h2>

                <div class="flex space-x-3">
                    <!-- Details Button -->
                    <a href="{{ route('genre.show', $genre) }}"
                       class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                        Details
                    </a>

                    <!-- Edit Button -->
                    <a href="{{ route('genre.edit', $genre) }}"
                       class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                        Edit
                    </a>

                    <!-- Delete Button -->
                    <form action="{{ route('genre.destroy', $genre) }}" method="POST"
                          onsubmit="return confirm('Are you sure you want to delete this genre?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>

