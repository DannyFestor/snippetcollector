<?php

namespace App\Http\Livewire\Snippets;

use App\Models\Snippet;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $tag = '';
    public string $search = '';
    public array $tags = [];
    public string $dir = 'desc';

    protected $queryString = [
        'tag' => ['except' => ''],
        'search' => ['except' => ''],
        'page' => ['except' => 1],
        'dir' => ['except' => 'desc'],
    ];

    public function mount()
    {
        $this->tags = Tag::query()
            ->select(['id', 'title', 'color', 'bgcolor', 'bordercolor'])
            ->withCount('snippets')
            ->having(
                'snippets_count',
                '>',
                0
            )->get()->toArray();
    }

    public function render()
    {
        $snippets = Snippet::query()
            ->with(['tags', 'user:id,name,email'])
            ->select(['id', 'user_id', 'title', 'description', 'published_at'])
            ->published()
            ->when($this->search, function (Builder $query, string $value) {
                $query->whereRaw('LOWER(snippets.title) like ?', Str::lower("%{$value}%"));
            })
            ->when($this->tag, function (Builder $query, string $value) {
                $query->whereHas('tags', function (Builder $query) use ($value) {
                    $query->where('tags.title', '=', $value);
                });
            })
            ->orderBy('snippets.published_at', $this->dir)
            ->paginate();
        $selectedTag = collect($this->tags)->first(fn($tag) => $tag[ 'title' ] === $this->tag);

        return view('livewire.snippets.index', compact('snippets', 'selectedTag'));
    }
}
