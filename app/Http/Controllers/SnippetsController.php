<?php

namespace App\Http\Controllers;

use App\Models\Snippet;
use Illuminate\Http\Request;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\MarkdownConverter;
use League\CommonMark\Parser\MarkdownParser;

class SnippetsController extends Controller
{
    public function index()
    {
        $snippets = Snippet::query()
            ->with(['tags'])->select(['id', 'title', 'description'])
            ->published()
            ->paginate();

        return view('snippets.index', compact('snippets'));
    }

    public function show(Snippet $snippet)
    {
        if (!$snippet->published_at || $snippet->published_at->lt(now())) {
            abort(404);
        }
        return view('snippets.show', compact('snippet'));
    }
}
