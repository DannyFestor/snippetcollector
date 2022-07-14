<x-app-layout>
    <div x-data="{ activeTab: 1 }" class="max-w-7xl w-full mx-auto sm:px-6 lg:px-8 flex flex-col space-y-4 mt-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-2">
            <x-snippets.tab-button @click="activeTab = 1"
                                   x-bind:class="{ 'bg-slate-400 text-white': (activeTab === 1) }">
                Description
            </x-snippets.tab-button>
            <x-snippets.tab-button @click="activeTab = 2"
                                   x-bind:class="{ 'bg-slate-400 text-white': (activeTab === 2) }">
                Video
            </x-snippets.tab-button>
            <x-snippets.tab-button @click="activeTab = 3"
                                   x-bind:class="{ 'bg-slate-400 text-white': (activeTab === 3) }">
                Code
            </x-snippets.tab-button>
            @if($snippet->examples->count() > 0)
                <x-snippets.tab-button @click="activeTab = 4"
                                       x-bind:class="{ 'bg-slate-400 text-white': (activeTab === 4) }">
                    Example
                </x-snippets.tab-button>
            @endif
        </div>

        <div x-show="activeTab === 1" x-cloak x-collapse class="prose w-full mx-auto line-numbers">
            {!! $snippet->markdown_description !!}
        </div>
        <div x-show="activeTab === 2" x-cloak x-collapse class="prose w-full mx-auto line-numbers">
            Video
        </div>
        <div x-show="activeTab === 3" x-cloak x-collapse class="w-full mx-auto w-full flex flex-col gap-2">
            @foreach($snippet->files as $file)
                <div x-data="{ open: false }" class="prose mx-auto line-numbers w-full flex flex-col">
                    <div @click="open = !open"
                         class="rounded border border-slate-400 hover:bg-slate-200 transition px-4 py-2 cursor-pointer">{{ $file->filename }}</div>
                    <div x-show="open" x-cloak x-collapse>
                        {!! $file->markdown_code !!}
                    </div>
                </div>
            @endforeach
        </div>
        @if($snippet->examples->count() > 0)
            <div x-show="activeTab === 4" x-cloak x-collapse class="prose w-full mx-auto line-numbers rounded">
                @foreach($snippet->examples as $example)
                    <div>
                        <div>
                            {{ $example->title }}
                        </div>
                        <div>
                            {!! $example->markdown_code !!}
                        </div>
                        <div>
                            {!! $example->implementation !!}
                        </div>
                        @if($example->styles)
                            @push('styles')
                                {!! $example->styles !!}
                            @endpush
                        @endif
                        @if($example->scripts)
                            @push('scripts')
                                {!! $example->scripts !!}
                            @endpush
                        @endif
                    </div>
                @endforeach
            </div>
        @endif

        {{-- TODO: Snippet Video, Snippet Code, Snippet Example... Tabs? --}}
    </div>

    @push('styles')
        @vite(['resources/css/prism.css', 'resources/js/prism.js'])
    @endpush
</x-app-layout>

