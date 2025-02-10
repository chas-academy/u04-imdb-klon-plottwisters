<div class="flex justify-center items-center w-full bg-white py-4 shadow-md">
    <form action="{{ url('/search') }}" method="GET" class="flex items-center">
        <input 
            type="text"
            name="search"
            placeholder="Search movies"
            class="px-4 py-2 w-full border rounded-lg text-gray-700 focus outline-none focus:ring focus ring-blue-500"
            value="{{ request('search') }} "
            >
            <button type="submit" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-lg">Search</button>
    </form>
</div>