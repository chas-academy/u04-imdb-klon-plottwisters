<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center w-xl px-3 py-2 bg-[#F15C5F] border border-transparent rounded-xl font-semibold text-xs text-black uppercase tracking-widest hover:bg-[#D93437] focus:bg-[#D93437] focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
