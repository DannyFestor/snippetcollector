<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index()
    {
        return view('tags.index');
    }

    public function show(Tag $tag)
    {
        return view('tags.show', compact('tag'));
    }
}
