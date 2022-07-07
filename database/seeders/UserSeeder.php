<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::factory()->create([
            'name' => 'Danny',
            'email' => 'danny@snippetcollector.dev',
        ]);
        User::factory(10)->create();
    }
}
