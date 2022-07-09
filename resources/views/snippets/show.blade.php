<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Snippets') }} - {{ $snippet->title }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="prose line-numbers p-8">
            {!! $snippet->markdown_description !!}
        </div>
    </div>

    @push('styles')
        @vite(['resources/css/prism.css', 'resources/js/prism.js'])
        {{--        <link rel="stylesheet" href="{{ asset('css/prism.css') }}">--}}
        {{--        <script src="{{ asset('js/prism.js') }}"></script>--}}
    @endpush
</x-app-layout>

