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
    ];

    /**
     * @return BelongsToMany
     */
    public function snippets() : BelongsToMany
    {
        return $this->belongsToMany(Snippet::class, SnippetTag::class);
    }
}
