<?php

namespace Database\Seeders;

use App\Models\Snippet;
use App\Models\User;
use Illuminate\Database\Seeder;

class SnippetSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        $users->each(fn (User $user) => Snippet::factory(10)->create(['user_id' => $user->id]));
    }
}
