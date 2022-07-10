<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'color',
        'bgcolor',
        'bordercolor',
        'logo',
    ];

    protected static function booted()
    {
        static::deleting(function ($tag) {
            if ($tag->logo) {
                \Illuminate\Support\Facades\File::delete(storage_path("app/public/{$tag->logo}"));
            }
        });
    }

    /**
     * @return BelongsToMany
     */
    public function snippets() : BelongsToMany
    {
        return $this->belongsToMany(Snippet::class, SnippetTag::class);
    }
}
