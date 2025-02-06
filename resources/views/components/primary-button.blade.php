<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center w-xl px-3 py-2 bg-teal-700 border border-transparent rounded-xl font-semibold text-xs text-black uppercase tracking-widest hover:bg-teal-800 focus:bg-teal-900 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
