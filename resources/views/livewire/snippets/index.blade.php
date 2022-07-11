<div class="w-full p-6 border-b border-gray-200 flex flex-col gap-4">
    <div class="w-full flex flex-col sm:flex-row gap-2 sm:items-center sm:justify-between">
        <label x-data="{ search: @entangle('search') }" class="flex items-center gap-4">
            Search
            <input x-model.debounce.500ms="search"
                   type="search"
                   placeholder="title"
                   aria-placeholder="Search title"
                   class="flex-1 sm:flex-auto rounded bg-slate-100 focus:bg-white focus:ring-0 border-2 border-slate-500 focus:border-blue-700 transition focus:scale-105"
            >
        </label>

        <div class="flex flex-col gap-2">
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

            <div x-data="{ dir: @entangle('dir') }" class="flex items-center gap-4">
                <label class="flex items-center gap-2">
                    New First
                    <input x-model="dir" value="desc" type="radio">
                </label>
                <label class="flex items-center gap-2">
                    Old First
                    <input x-model="dir" value="asc" type="radio">
                </label>
            </div>
        </div>
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

    <div class="grid flex flex-col gap-4">
        @foreach($snippets as $snippet)
            <div class="w-full flex flex-col md:flex-row md:flex-wrap p-2 rounded bg-white shadow-lg">
                <a href="{{ route('snippets.show', $snippet) }}"
                   class="block flex flex-col gap-2 w-full md:w-3/4 p-2 hover:bg-slate-200 transition rounded hover:scale-105 hover:shadow-xl hover:-rotate-1"
                >
                    <div class="font-bold">
                        {{$snippet->title}}
                    </div>
                    <div>
                        {{ $snippet->user->email }} - {{ $snippet->published_at->format('Y/m/d') }}
                    </div>
                </a>
                <div class="flex justify-evenly items-start gap-2 w-full md:w-1/4 flex-wrap p-2 rounded">
                    @foreach($snippet->tags as $tag)
                        <x-tags.display wire:click="$set('tag', '{{ $tag->title }}');"
                                        :color="$tag->color"
                                        :bgcolor="$tag->bgcolor"
                                        :bordercolor="$tag->bordercolor"
                                        class="transition hover:scale-105 odd:rotate-3 even:-rotate-3 hover:rotate-0 hover:shadow-lg"
                        >
                            {{ $tag->title }}
                        </x-tags.display>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    {{ $snippets->links() }}
</div>
