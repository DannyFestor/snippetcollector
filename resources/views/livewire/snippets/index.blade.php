<div class="p-6 bg-white border-b border-gray-200">
    <div>
        @if($tag && $selectedTag)
            <div>Selected Tag:
                <x-tags.display wire:click="$set('tag', null);"
                                :color="$selectedTag['color']"
                                :bgcolor="$selectedTag['bgcolor']"
                                :bordercolor="$selectedTag['bordercolor']">
                    {{ $selectedTag['title'] }}
                </x-tags.display>

            </div>
        @endif
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @foreach($snippets as $snippet)
            <a href="{{ route('snippets.show', $snippet) }}"
               class="md:col-span-2 lg:col-span-3 p-2 border-b border-slate-200 hover:bg-slate-200 transition-colors rounded"
            >
                {{$snippet->title}}
            </a>
            <div class="flex justify-evenly gap-2 flex-wrap p-2 border-b border-slate-200 rounded">
                @foreach($snippet->tags as $tag)
                    <x-tags.display wire:click="$set('tag', '{{ $tag->title }}');"
                                    :color="$tag->color"
                                    :bgcolor="$tag->bgcolor"
                                    :bordercolor="$tag->bordercolor">
                        {{ $tag->title }}
                    </x-tags.display>
                @endforeach
            </div>
        @endforeach
    </div>

    {{ $snippets->links() }}
</div>
