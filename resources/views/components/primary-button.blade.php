<button
    {{ $attributes->merge([
        'type' => 'submit',
        'class' => '
            inline-flex items-center justify-center
            px-5 py-2.5
            bg-indigo-600
            text-white font-semibold text-sm tracking-wide
            rounded-md shadow-sm
            hover:bg-indigo-700
            focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2
            active:bg-indigo-800 active:scale-95
            transition-all duration-200 ease-in-out
        ',
    ]) }}
>
    {{ $slot }}
</button>
