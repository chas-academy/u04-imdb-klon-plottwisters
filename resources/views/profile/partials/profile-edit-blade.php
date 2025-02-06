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
