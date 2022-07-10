@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex bg-white md:bg-inherit items-center p-4 md:p-0 md:px-1 md:pt-1 border-l-8 md:border-l-0 border-b-0 md:border-b-2 border-slate-700 text-sm font-medium leading-5 text-slate-900 focus:outline-none focus:border-slate-700 transition duration-150 ease-in-out'
            : 'inline-flex bg-white md:bg-inherit items-center p-4 md:p-0 md:px-1 md:pt-1 border-l-8 md:border-l-0 border-b-0 md:border-b-2 border-transparent text-sm font-medium leading-5 text-slate-500 hover:text-slate-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
