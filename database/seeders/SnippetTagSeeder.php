<?php

namespace Database\Seeders;

use App\Models\Snippet;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class SnippetTagSeeder extends Seeder
{
    public function run()
    {
        $snippets = Snippet::all();
        $tags = Tag::all();

        $snippets->each(fn (Snippet $snippet) => $snippet->tags()->attach($tags->random(random_int(1, $tags->count()))));
    }
}
