<div class="flex flex-col gap-4">
    <div x-data="{
        search: @entangle('search'),
        order: @entangle('order'),
        dir: @entangle('dir'),
    }"
         class="flex justify-between"
    >
        <label class="flex items-center gap-2">
            Search Tag
            <input x-model.debounce.500ms="search"
                   type="search"
                   placeholder="title"
                   aria-placeholder="Search title"
                   class="flex-1 max-w-[200px] sm:flex-auto rounded bg-slate-100 focus:bg-white focus:ring-0 border-2 border-slate-500 focus:border-blue-700 transition focus:scale-105"
            >
        </label>

        <div class="flex flex-col gap-2">
            <label>
                Order
                <select x-model="order">
                    <option value="">Title</option>
                    <option value="snippets_count">No. Snippets</option>
                    <option value="updated">Updated</option>
                </select>
            </label>
            <div class="flex items-center gap-2">
                Direction
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
            <div class="flex flex-col items-center rounded bg-white shadow p-4">
                @if($tag->logo)
                    <img src="/{{ $tag->logo }}" class="w-12 h-12" alt="">
                @endif
                {{ $tag->title }} {{ $tag->snippets_count }} {{ $tag->updated }}
            </div>
        @endforeach
    </div>
</div>
