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

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        @foreach($collections as $collection)
            <div class="flex flex-col md:flex-row md:flex-wrap p-2 rounded bg-white shadow-lg">
                <a href="{{ route('collections.show', $collection) }}"
                   class="w-full max-h-[100px] flex items-center gap-2 p-2 hover:bg-slate-200 transition rounded hover:scale-105 hover:shadow-xl hover:-rotate-1"
                >
                    @if($collection->thumbnail)
                        <div class="w-full max-w-[100px] h-full max-h-[100px]">
                            <img src="{{ $collection->thumbnail }}"
                                 alt="Thumbnail for collection {{ $collection->title }}"
                                 class="w-full h-full"
                            >
                        </div>
                    @endif
                    <div class="font-bold">
                        {{$collection->title}}
                    </div>
                </a>
                @if($collection->snippets->count() > 0)
                    <div class="flex flex-col divide-y w-full">
                        @foreach($collection->snippets as $snippet)
                            <a href="{{ route('snippets.show', $snippet) }}" class="flex gap-0.5 w-full py-2 transition hover:bg-slate-200 hover:scale-105 hover:rotate-3">
                                <div class="min-w-[35px] text-right">{{ $collection->snippets->count() - $loop->index }}.</div>
                                <div>{{ $snippet->title }}</div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    {{ $collections->links() }}
</div>
