<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;

class CollectionsController extends Controller
{
    public function index()
    {
        return view('collections.index');
    }

    public function show(Collection $collection)
    {
        $collection->load([
            'snippets' => function (HasMany $query) {
                $query->orderBy('order_column');
            }
        ]);

        if ($collection->snippets->count() === 0) {
            abort(404);
        }

        return view('collections.show', compact('collection'));
    }
}
