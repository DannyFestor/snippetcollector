<?php

namespace App\Http\Livewire\Collections;

use App\Models\Collection;
use App\Models\Snippet;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $search = '';
    public string $dir = 'desc';

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
        'dir' => ['except' => 'desc'],
    ];

    public function render()
    {
        $collections = Collection::query()
            ->with([
                'snippets' => function (HasMany $query) {
                    $query
                        ->select(['id','collection_id','title','description', 'order_column'])
                        ->limit(5)
                        ->orderBy('order_column', 'desc');
                },
            ])
            ->whereHas('snippets')
            ->select(['id', 'title', 'thumbnail'])
            ->when($this->search, function (Builder $query, string $value) {
                $query->whereRaw('LOWER(collections.title) like ?', Str::lower("%{$value}%"));
            })
            ->orderBy('collections.updated_at', $this->dir)
            ->paginate();

        return view('livewire.collections.index', compact('collections'));
    }
}
