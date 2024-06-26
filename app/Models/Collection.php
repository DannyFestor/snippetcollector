<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Collection extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'thumbnail',
    ];

    /**
     * @return HasMany
     */
    public function snippets() : HasMany
    {
        return $this->hasMany(Snippet::class);
    }
}
