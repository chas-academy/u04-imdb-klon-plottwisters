<div class="flex flex-col items-center space-y-2">
    <div class="flex flex-row gap-1 items-center">
        <img src="./images/star.png" alt="">
        <p class="text-[#A693FF]">{{ round($movie->average_rating, 1) }} / 10</p>
    </div>
    @auth
    @php
    $userRating = ($movie->ratings ?? collect())->where('user_id', auth()->id())->first();
    @endphp

    <form action="{{ route('ratings.store', $movie) }}" method="POST" class="flex items-center space-x-2">
        @csrf
        <select name="rating" class="p-1 border border-gray-500 rounded bg-white text-black w-[50px]">
            @for ($i = 1; $i <= 10; $i++)
                <option value="{{ $i }}" {{ $userRating && $userRating->rating == $i ? 'selected' : '' }}>
                {{ $i }}
                </option>
                @endfor
        </select>
        <x-primary-button>
            Submit
        </x-primary-button>
    </form>



    @if ($userRating)
    <p class="text-sm text-gray-400">Your Rating: {{ $userRating->rating }} / 10</p>
    @endif
    @else
    <p class="text-sm text-gray-400">Sign in to rate</p>
    @endauth
</div>