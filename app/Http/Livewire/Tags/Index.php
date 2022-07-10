<?php

namespace App\Http\Livewire\Tags;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Livewire\Component;

class Index extends Component
{
    public string $search = '';
    public string $order = '';
    public string $dir = 'asc';

    protected $queryString = [
        'search' => ['except' => ''],
        'order' => ['except' => ''],
        'dir' => ['except' => 'asc'],
    ];


    public function render()
    {
        $tags = Tag::select('tags.id', 'tags.title', 'tags.logo')
            ->whereNotNull('snippets.published_at')
            ->where('snippets.published_at', '<', now())
            ->selectRaw('max(snippets.created_at) as updated')
            ->join(
                'snippet_tag',
                'snippet_tag.tag_id',
                '=',
                'tags.id'
            )
            ->join('snippets', 'snippets.id', '=', 'snippet_tag.snippet_id')
            ->groupBy('tags.id', 'tags.title', 'tags.logo')
            ->withCount('snippets')
            ->when($this->search, function (Builder $query, string $value) {
                $query->whereRaw('LOWER(tags.title) like ?', Str::lower("%{$value}%"));
            })
            ->when($this->order, function (Builder $query, string $value) {
                $query->orderBy($value, $this->dir);
            }, function (Builder $query) {
                $query->orderBy('tags.title', $this->dir);
            })
            ->distinct()
            ->get();

        return view('livewire.tags.index', compact('tags'));
    }
}
