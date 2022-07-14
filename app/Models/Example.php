<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use League\CommonMark\CommonMarkConverter;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Example extends Model implements Sortable
{
    use HasFactory;
    use SortableTrait;

    protected $fillable = [
        'snippet_id',
        'title',
        'code',
        'implementation',
        'scripts',
        'styles',
    ];

    public function buildSortQuery()
    {
        return static::query()->where('snippet_id', $this->snippet_id);
    }

    protected function markdownCode() : Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => (new CommonMarkConverter())->convert($attributes[ 'code' ]),
        );
    }

    /**
     * @return BelongsTo
     */
    public function snippet() : BelongsTo
    {
        return $this->belongsTo(Snippet::class);
    }
}
