<div class="p-6 bg-white border-b border-gray-200 flex flex-col gap-4">
    <div class="flex flex-col sm:flex-row gap-2 sm:items-center sm:justify-between">
        <label x-data="{ search: @entangle('search') }" class="flex items-center gap-4">
            Search
            <input x-model.debounce.500ms="search"
                   type="search"
                   placeholder="title"
                   aria-placeholder="Search title"
                   class="flex-1 sm:flex-auto rounded bg-slate-100 focus:bg-white focus:ring-0 border-2 border-slate-500 focus:border-blue-700 transition focus:scale-105"
            >
        </label>

        <select x-data="{ tag: @entangle('tag') }"
                x-model="tag"
                name="tag"
                id="tag"
                class="rounded bg-slate-100 focus:bg-white focus:ring-0 border-2 border-slate-500 focus:border-blue-700"
        >
            <option value="">All Tags</option>
            @foreach($tags as $t)
                <option value="{{ $t['title'] }}">{{ $t['title'] }}</option>
            @endforeach
        </select>
    </div>


    <div>
        @if($tag && $selectedTag)
            <div>Selected Tag:
                <x-tags.display wire:click="$set('tag', '');"
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
               class="block flex flex-col gap-2 md:col-span-2 lg:col-span-3 p-2 border-b border-slate-200 hover:bg-slate-200 transition-colors rounded"
            >
                <div class="font-bold">
                    {{$snippet->title}}
                </div>
                <div>
                    {{ $snippet->user->email }} - {{ $snippet->published_at->format('Y/m/d') }}
                </div>
            </a>
            <div class="flex justify-evenly items-start gap-2 flex-wrap p-2 border-b border-slate-200 rounded">
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
