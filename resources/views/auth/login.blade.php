<x-guest-layout>
    <div class="flex flex-col lg:flex-row items-center justify-center lg:items-start w-full lg:w-3/4 mx-auto mt-10">
        <div class="w-full lg:w-1/2">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <h2 class="text-xl font-bold mb-4">Sign in</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-white" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" class="text-white" />
                    <x-text-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-white shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ms-2 text-sm text-white">{{ __('Remember me') }}</span>
                    </label>
                </div>

                @if (Route::has('password.request'))
                    <a class="underline text-sm text-white hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <div class="flex flex-col items-center justify-center mt-4">
                    <x-primary-button class="ms-3">
                        {{ __('Sign in') }}
                    </x-primary-button>
                    <p class="mt-4">or</p>
                    <x-primary-button class="ms-3 mt-4" onclick="window.location='{{ route('register') }}'">
                        {{ __('Create new account') }}
                    </x-primary-button>
                </div>
            </form>
        </div>

        <!-- Benefit section -->
        <section class="w-full lg:w-1/2 mt-8 lg:mt-0 lg:pl-10 text-center lg:text-left">
            <h2 class="text-xl font-bold">Benefits of your free PlotTwisters account</h2>
            <h4 class="font-semibold mt-4 text-indigo-400">Personalized Recommendations</h4>
            <p>Discover movies you love</p>
            <h4 class="font-semibold mt-4 text-indigo-400">Your Watchlist</h4>
            <p>Track everything you want to watch and receive e-mail when movies open in theaters.</p>
            <h4 class="font-semibold mt-4 text-indigo-400">Your Ratings</h4>
            <p>Rate and remember everything you've seen.</p>
        </section>

    </div>
</x-guest-layout>
