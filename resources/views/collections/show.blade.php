<x-app-layout>
    <div class="max-w-7xl w-full mx-auto sm:px-6 lg:px-8 flex flex-col space-y-4 mt-4">
        <div class="w-full flex flex-col sm:flex-row gap-4">
            <div class="w-full sm:w-1/4">
                <div class="flex flex-col rounded shadow bg-white p-4">
                    <div class="text-2xl font-bold font-slate-800">{{ $collection->title }}</div>
                    <div class="text-sm text-slate-400">{{ $collection->description }}</div>
                </div>
            </div>

            <div class="flex-1 flex flex-col divide-y divide-slate-200 bg-white rounded shadow">
                @foreach($collection->snippets as $snippet)
                    <a href="{{ route('snippets.show', $snippet) }}" class="p-4 odd:bg-white even:bg-slate-50 transition hover:scale-105 hover:-rotate-1 hover:bg-slate-200">{{ $loop->iteration }}. {{ $snippet->title }}</a>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>

