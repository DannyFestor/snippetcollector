<div class="flex flex-col gap-4">
    <div x-data="{
        search: @entangle('search'),
        order: @entangle('order'),
        dir: @entangle('dir'),
    }"
         class="flex flex-col sm:flex-row sm:justify-between gap-2"
    >
        <label class="flex items-center gap-2">
            <span class="w-[80px] sm:w-auto inline-block">Search Tag</span>
            <input x-model.debounce.500ms="search"
                   type="search"
                   placeholder="title"
                   aria-placeholder="Search title"
                   class="flex-1 max-w-[200px] sm:flex-auto rounded bg-slate-100 focus:bg-white focus:ring-0 border-2 border-slate-500 focus:border-blue-700 transition focus:scale-105"
            >
        </label>

        <div class="flex flex-col gap-2">
            <label class="flex items-center gap-2">
                <span class="w-[80px] sm:w-auto inline-block">Order</span>
                <select x-model="order"
                        class="flex-1 max-w-[200px] sm:flex-auto rounded bg-slate-100 focus:bg-white focus:ring-0 border-2 border-slate-500 focus:border-blue-700 transition focus:scale-105">
                    <option value="">Title</option>
                    <option value="snippets_count">No. Snippets</option>
                    <option value="updated">Updated</option>
                </select>
            </label>
            <div class="flex items-center gap-2">
                <span class="w-[80px] sm:w-auto inline-block">Direction</span>
                <label class="flex items-center gap-2">
                    <input type="radio" name="dir" id="dir" x-model="dir" value="asc">Asc.
                </label>
                <label class="flex items-center gap-2">
                    <input type="radio" name="dir" id="dir" x-model="dir" value="desc">Desc.
                </label>

            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
        @foreach($tags as $tag)
            <a href="{{ route('snippets.index', ['tag' => $tag->title]) }}" class="flex flex-col items-center rounded bg-white shadow p-4 transition hover:scale-105 hover:rotate-3 hover:shadow-xl">
                @if($tag->logo)
                    <img src="/{{ $tag->logo }}" class="w-12 h-12" alt="">
                @endif
                    <p class="text-lg font-bold text-slate-800">{{ $tag->title }}</p>
                    <p class="text-sm text-slate-600">{{ $tag->snippets_count }} Snippets</p>
                    <p class="text-sm text-slate-600">Updated {{ \Carbon\Carbon::parse($tag->updated)->format('Y/m/d') }}</p>
            </a>
        @endforeach
    </div>
</div>
