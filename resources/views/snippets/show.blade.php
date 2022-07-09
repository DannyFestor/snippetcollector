<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Snippets') }} - {{ $snippet->title }}
        </h2>
    </x-slot>

    <div x-data="{ activeTab: 1 }" class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col space-y-4 mt-4">
        <div class="grid grid-cols-4">
            <x-snippets.tab-button @click="activeTab = 1"
                                   x-bind:class="{ 'bg-slate-400 text-white': (activeTab === 1) }">
                Description</x-snippets.tab-button>
            <x-snippets.tab-button @click="activeTab = 2"
                                   x-bind:class="{ 'bg-slate-400 text-white': (activeTab === 2) }">
                Video</x-snippets.tab-button>
            <x-snippets.tab-button @click="activeTab = 3"
                                   x-bind:class="{ 'bg-slate-400 text-white': (activeTab === 3) }">
                Code</x-snippets.tab-button>
            <x-snippets.tab-button @click="activeTab = 4"
                                   x-bind:class="{ 'bg-slate-400 text-white': (activeTab === 4) }">
                Example</x-snippets.tab-button>
        </div>

        <div x-show="activeTab === 1" x-cloak x-collapse class="prose mx-auto line-numbers">
            {!! $snippet->markdown_description !!}
        </div>
        <div x-show="activeTab === 2" x-cloak x-collapse class="prose mx-auto line-numbers">
            Video
        </div>
        <div x-show="activeTab === 3" x-cloak x-collapse class="mx-auto w-full flex flex-col gap-2">
            @foreach($snippet->files as $file)
                <div x-data="{ open: false }" class="prose mx-auto line-numbers w-full flex flex-col">
                    <div @click="open = !open" class="rounded border border-slate-400 hover:bg-slate-200 transition px-4 py-2 cursor-pointer">{{ $file->filename }}</div>
                    <div x-show="open" x-cloak x-collapse>
                        {!! $file->markdown_code !!}
                    </div>
                </div>
            @endforeach
        </div>
        <div x-show="activeTab === 4" x-cloak x-collapse class="prose mx-auto line-numbers">
            Example
        </div>

       {{-- TODO: Snippet Video, Snippet Code, Snippet Example... Tabs? --}}
    </div>

    @push('styles')
        @vite(['resources/css/prism.css', 'resources/js/prism.js'])
    @endpush
</x-app-layout>

