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
                                        {{ Auth::user()->profile_picture == $picture ? 'checked' : '' }}>
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
         <div x-data="{ showEdit: false }" >
        <x-primary-button @click="showEdit = !showEdit">
            Edit Profile
        </x-primary-button>
        <div x-show="showEdit" class="p-4 sm:p-8 mt-2rounded-md">
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
    </div>
</x-app-layout>
