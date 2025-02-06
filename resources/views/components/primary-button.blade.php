<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center w-xl px-10 py-5 bg-emerald-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-800 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
