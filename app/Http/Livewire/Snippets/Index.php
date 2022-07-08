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

    public ?int $tag = null;
    public array $tags = [];

    public function mount()
    {
        $this->tags = Tag::select(['id', 'title', 'color', 'bgcolor', 'bordercolor'])->get()->toArray();
    }

    public function render()
    {
        $snippets = Snippet::query()
            ->with(['tags'])->select(['id', 'title', 'description'])
//            ->published()
            ->when($this->tag, function (Builder $query, int $value) {
                $query->whereHas('tags', function (Builder $query) use ($value) {
                    $query->where('tags.id', '=', $value);
                });
            })
            ->paginate();
        $selectedTag = collect($this->tags)->first(fn($tag) => $tag['id'] === $this->tag);

        return view('livewire.snippets.index', compact('snippets', 'selectedTag'));
    }
}
