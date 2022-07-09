<?php

namespace App\Http\Livewire\Snippets;

use App\Models\Snippet;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public ?string $tag = null;
    public array $tags = [];

    protected $queryString = [
        'tag' => ['except' => ['']],
        'page' => ['except' => 1],
    ];

    public function mount()
    {
        $this->tags = Tag::select(['id', 'title', 'color', 'bgcolor', 'bordercolor'])->get()->toArray();
    }

    public function render()
    {
        $snippets = Snippet::query()
            ->with(['tags'])->select(['id', 'title', 'description'])
            ->published()
            ->when($this->tag, function (Builder $query, string $value) {
                $query->whereHas('tags', function (Builder $query) use ($value) {
                    $query->where('tags.title', '=', $value);
                });
            })
            ->paginate();
        $selectedTag = collect($this->tags)->first(fn($tag) => $tag['title'] === $this->tag);

        return view('livewire.snippets.index', compact('snippets', 'selectedTag'));
    }
}
