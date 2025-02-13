<div class="flex justify-center">
    <form action="{{ url('/search') }}" method="GET" class="flex">
        <input
            type="text"
            name="search"
            placeholder="Search movies..."
            class="px-2 py-1 border rounded-xl text-gray-700 focus:outline-none mr-2 w-50 md:w-60 lg:w-96"
            value="{{ request('search') }}">
        {{-- <button type="submit" class="ml-2 px-3 py-1 bg-blue-500 text-white rounded">Search</button> --}}
        <x-primary-button>Search</x-primary-button>
    </form>
</div>