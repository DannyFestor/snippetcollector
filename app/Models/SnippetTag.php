<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class SnippetTag extends Pivot
{
    protected $table = 'snippet_tag';
    protected $fillable = [
        'snippet_id',
        'tag_id',
    ];
}
