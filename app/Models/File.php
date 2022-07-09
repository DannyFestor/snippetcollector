<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use League\CommonMark\CommonMarkConverter;

class File extends Model
{
    protected $fillable = [
        'snippet_id',
        'filename',
        'language',
        'code',
    ];

    protected function markdownCode() : Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => (new CommonMarkConverter())->convert(
                <<<MARKDOWN
```{$attributes['language']}
{$attributes['code']}
```
MARKDOWN
            ),
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
