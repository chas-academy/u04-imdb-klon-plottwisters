<div>
 <h1 class="text-2xl font-bold text-gray-800">Edit Genre</h1>

    <form action="{{ route('genre.update', $genre) }}" method="POST" class="mt-6">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="genre_name" class="block text-gray-700 font-medium">Genre Name</label>
            <input type="text" id="genre_name" name="genre_name" value="{{ old('genre_name', $genre->genre_name) }}"
                   class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" required>
        </div>

        <div class="flex items-center space-x-4">
            <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                Save Changes
            </button>
            <a href="{{ route('genre.show', $genre) }}"
               class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                Cancel
            </a>
        </div>
    </form>
</div>
