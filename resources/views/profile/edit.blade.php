<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <!-- Display Profile Picture -->
        <div class="flex flex-col items-center space-y-4">
            <img src="{{ asset('images/' . (Auth::user()->profile_picture ?? 'profile1.png')) }}" 
                 class="w-32 h-32 rounded-full border-2 border-gray-300" 
                 alt="Profile Picture">
            <div x-data="{ showPicture: false }">
                <!-- Toggle Button -->
                <x-primary-button @click="showPicture = !showPicture"
                    class="bg-blue-500 px-4 py-2 rounded-md my-4">
                    Edit Profile Picture
                </x-primary-button>
                <div x-show="showPicture" class="mt-4" x-transition>
                    <form method="POST" action="{{ route('profile.update-picture') }}">
                        @csrf
                        <label class="block text-sm font-medium text-gray-700">Choose a Profile Picture:</label>
                        <div class="flex space-x-4 my-4">
                            @php
                                $availablePictures = ['profile1.png', 'profile2.png', 'profile3.png'];
                            @endphp
                            @foreach ($availablePictures as $picture)
                                <label class="cursor-pointer">
                                    <input type="radio" name="profile_picture" value="{{ $picture }}" 
                                        {{ Auth::user()->profile_picture == $picture ? 'checked' : '' }} />
                                    <img src="{{ asset('images/' . $picture) }}" 
                                         class="w-24 h-24 rounded-full border-2 border-transparent hover:border-blue-500">
                                </label>
                            @endforeach
                        </div>
                        <x-primary-button class="mt-4">Save</x-primary-button>
                    </form>
                </div>
            </div>
        </div>

        <!-- User Profile Details -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="text-white text-center">
                <h2 class="font-bold">My Profile</h2>
                <h3>{{ Auth::user()->name }}</h3>
                <h4>{{ Auth::user()->email }}</h4>
            </div>
            <div class="flex justify-center space-x-4 mt-4 items-start">
                <div x-data="{ showEdit: false }">
                    <x-primary-button @click="showEdit = !showEdit">
                        Edit Profile
                    </x-primary-button>
                    <div x-show="showEdit" class="p-4 sm:p-8 mt-2 rounded-md">
                        <div class="max-w-xl">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                        <div class="max-w-xl mt-4">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>
                <x-primary-button>
                    Delete Account
                </x-primary-button>
            </div>
        </div>
        <!-- Watchlist Section -->
         <div class="pl-4">
        <h2 class="text-xl font-bold mt-6 text-white">My Watchlists</h2>

        <!-- Create Watchlist -->
        <div x-data="{ showForm: false }">
            <x-primary-button @click="showForm = !showForm">
                Create New Watchlist
            </x-primary-button>

            <div x-show="showForm" x-transition class="mt-4">
                <form action="{{ route('watchlists.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="watchlist_name" class="text-white">Watchlist Name</label>
                        <input type="text" id="watchlist_name" name="watchlist_name" class="form-control" required />
                    </div>
                    <x-primary-button type="submit" class="btn btn-primary">Create Watchlist</x-primary-button>
                </form>
            </div>
        </div>
        
        <!-- Select Watchlist -->
        <div x-data="{ selectedWatchlist: '' }">
            <label for="watchlist" class="text-white">Select a Watchlist</label>
            <select x-model="selectedWatchlist" id="watchlist" class="form-select my-4">
                <option value="" disabled selected>Select Watchlist</option>
                @foreach (Auth::user()->watchlists as $watchlist)
                    <option value="{{ $watchlist->id }}">{{ $watchlist->watchlist_name }}</option>
                @endforeach
            </select>

            <!-- Display Movies for the Selected Watchlist -->
            <div x-show="selectedWatchlist" class="mt-4">
                <h3 class="text-lg font-semibold text-white">Movies in this Watchlist</h3>
                @foreach (Auth::user()->watchlists as $watchlist)
                    <div x-show="selectedWatchlist == {{ $watchlist->id }}" class="p-4 mt-4">
                        <ul class="flex flex-row flex-wrap">
                            @foreach ($watchlist->movies as $movie)
                                <li class="flex justify-between my-2 text-white">
                                    <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-info">
                                        <img src="{{ $movie->image_url }}" alt="" >
                                        {{ $movie->title }}
                                    </a>
                                    <form action="{{ route('watchlists.removeMovie', [$watchlist->id, $movie->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500">Remove</button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>

                        <!-- Delete Watchlist -->
                        <form action="{{ route('watchlists.delete', $watchlist->id) }}" method="POST" class="mt-4">
                            @csrf
                            @method('DELETE')
                            <x-primary-button type="submit">Delete Watchlist</x-primary-button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
        </div>

    </div>
</x-app-layout>
