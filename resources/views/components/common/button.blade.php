@props([
    'class' => '', 
    'onClick' => '', 
])

<button {{ $attributes->merge([
        'class' => 'inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest transition ease-in-out duration-150 ' . 
        ($class ? $class : 'bg-gray-800 dark:bg-gray-200 text-white dark:text-gray-800 hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-[#BEEBFF] focus:ring-offset-2 dark:focus:ring-offset-gray-800')
    ]) }}
    @if($onClick) onclick="{{ $onClick }}" @endif>
    {{ $slot }}
</button>
