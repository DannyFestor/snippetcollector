<?php

namespace App\Http\Controllers;

use App\Models\Snippet;
use Illuminate\Http\Request;

class SnippetsController extends Controller
{
    public function index()
    {
        $snippets = Snippet::query()
            ->with(['tags'])->select(['id', 'title', 'description'])
            ->paginate();

        return view('snippets.index', compact('snippets'));
    }

    public function show(Snippet $snippet)
    {
        return view('snippets.show', compact('snippet'));
    }
}
