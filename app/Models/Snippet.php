<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Parser\MarkdownParser;

class Snippet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'example',
        'scripts',
        'styles',
    ];

    protected function markdownDescription(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => (new CommonMarkConverter())->convert($attributes['description']),
        );
    }

    /**
     * @return BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsToMany
     */
    public function tags() : BelongsToMany
    {
        return $this->belongsToMany(Tag::class, SnippetTag::class);
    }
}
