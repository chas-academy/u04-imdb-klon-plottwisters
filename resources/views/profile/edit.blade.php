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
        
        @if(session('success'))
            <div class="bg-green-500 text-white p-2 rounded-md text-center">
                {{ session('success') }}
            </div>
        @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="text-white">
                <h2 class="font-bold">My Profile</h2>
                <h3>{{ Auth::user()->name }}</h3>
                <h4>{{ Auth::user()->email }}</h4>
            </div>
            
            <div class="flex justify-start align-end">
                <div x-data="{ showEdit: false }">
                    <div class="mt-4">
                        <x-primary-button @click="showEdit = !showEdit"
                        class="bg-blue-500 text-white px-4 py-2 rounded-md my-4">
                        Edit Profile
                    </x-primary-button>
                </div>
                
                <div x-show="showEdit" class="p-4 sm:p-8" x-transition>
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
                
                <div x-show="showEdit" class="p-4 sm:p-8" x-transition>
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>
            
            <div class="p-4 sm:p-8">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
