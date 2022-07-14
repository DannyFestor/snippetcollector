<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Parser\MarkdownParser;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Snippet extends Model implements Sortable
{
    use HasFactory;
    use SortableTrait;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function buildSortQuery()
    {
        return static::query()->where('collection_id', $this->collection_id);
    }

    protected function markdownDescription() : Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => (new CommonMarkConverter())->convert($attributes[ 'description' ]),
        );
    }

    public function scopePublished(Builder $query)
    {
        return $query
            ->where(function (Builder $query) {
                $query
                    ->whereNotNull('snippets.published_at')
                    ->orWhere('snippets.published_at', '<', now());
            });
    }

    /**
     * @return BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function collection() : BelongsTo
    {
        return $this->belongsTo(Collection::class);
    }

    /**
     * @return BelongsToMany
     */
    public function tags() : BelongsToMany
    {
        return $this->belongsToMany(Tag::class, SnippetTag::class);
    }

    /**
     * @return HasMany
     */
    public function files() : HasMany
    {
        return $this->hasMany(File::class);
    }

    /**
     * @return HasMany
     */
    public function examples() : HasMany
    {
        return $this->hasMany(Example::class);
    }
}
