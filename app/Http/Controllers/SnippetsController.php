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
        return view('snippets.index');
    }

    public function show(Snippet $snippet)
    {
        if (!$snippet->published_at || $snippet->published_at->gt(now())) {
            abort(404);
        }
        return view('snippets.show', compact('snippet'));
    }
}
