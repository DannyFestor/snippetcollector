<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use League\CommonMark\CommonMarkConverter;

class Example extends Model
{
    use HasFactory;

    protected $fillable = [
        'snippet_id',
        'title',
        'code',
        'implementation',
        'scripts',
        'styles',
    ];

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
