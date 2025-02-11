<div class="flex justify-center py-2">
    <form action="{{ url('/search') }}" method="GET" class="flex">
        <input
            type="text"
            name="search"
            placeholder="Search movies..."
            class="px-2 py-1 border rounded text-gray-700 focus:outline-none"
            value="{{ request('search') }}">
        <button type="submit" class="ml-2 px-3 py-1 bg-blue-500 text-white rounded">Search</button>
    </form>
</div>