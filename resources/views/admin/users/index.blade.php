<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin') }}
        </h2>
    </x-slot>
    <div class="w-full lg:w-2/3 mx-auto mt-4 px-4">
        <h2 class="text-white text-center text-4xl font-bold mb-4">Admin Panel</h2>
        <div class="overflow-x-auto">
        <table class="min-w-full text-white border-collapse">
            <thead>
                <tr class="bg-gray-700">
                    <th class="px-6 py-4 text-center">Profile Picture</th>
                    <th class="px-6 py-4 text-center">Username</th>
                    <th class="px-6 py-4 text-center">Email</th>
                    <th class="px-6 py-4 text-center">Role</th>
                    <th class="px-6 py-4 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="border-t border-gray-600">
                        <td class="px-6 py-4 text-center">
                            <img src="{{ asset('images/' . ($user->profile_picture ?? 'profile1.png')) }}" 
                                class="w-12 h-12 rounded-full border-2 border-gray-300" 
                                alt="User Profile Picture">
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if ($editingUserId == $user->id)
                                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <x-text-input name="name" :value="old('name', $user->name)" required />
                            @else
                                <span>{{ $user->name }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if ($editingUserId == $user->id)
                                <x-text-input type="email" name="email" :value="old('email', $user->email)" required />

                                <div class="inline-flex space-x-2 mt-2 justify-center">
                                    <x-primary-button type="submit">Save</x-primary-button>
                                </div>
                            @else
                                <span>{{ $user->email }}</span>
                            @endif
                            </form>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($user->is_admin)
                                <span>Admin</span>
                            @else
                                <span>User</span>
                            @endif

                            <!-- Toggle Role Button -->
                            <form action="{{ route('admin.users.toggleRole', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <x-primary-button type="submit" class="mt-2">
                                    {{ $user->is_admin ? 'Revoke Admin' : 'Make Admin' }}
                                </x-primary-button>
                            </form>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="inline-flex space-x-4 justify-center">
                                @if ($editingUserId != $user->id)
                                    <x-primary-button>
                                        <a href="{{ route('admin.users.index', ['editingUserId' => $user->id]) }}">Edit</a>
                                    </x-primary-button>
                                @endif

                                <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <x-primary-button type="submit" onclick="return confirm('Are you sure you want to delete this user?')">Delete
                                    </x-primary-button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
				<!--- ADD REVIEWS --->
        <div class="mt-16">
            <h2 class="font-bold text-2xl text-white mb-4">User Reviews</h2>
            <div class="flex flex-row flex-wrap ">
                @foreach ($reviews as $review)
                    <div class="bg-white p-6 rounded-md shadow-md relative m-6 w-4/5 md:w-2/5">
                        <!-- Delete Button -->
                        @if (auth()->user()->is_admin || auth()->id() == $review->user_id)
                            <form action="{{ route('review.destroy', $review->id) }}" method="POST" class="absolute top-4 right-4">
                                @csrf
                                @method('DELETE')
                                <x-primary-button type="submit" 
                                    onclick="return confirm('Are you sure you want to delete this review?')">
                                    Delete
                                </x-primary-button>
                            </form>
                        @endif

                        <!-- User Information -->
                        <p class="text-sm text-gray-500 mb-2">
                            Posted by <strong>{{ $review->user->name }}</strong>
                        </p>

                        <!-- Review Content -->
                        <h3 class="font-bold text-lg">{{ $review->title }}</h3>
                        <p class="mt-2">{{ $review->description }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
