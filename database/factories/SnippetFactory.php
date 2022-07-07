<?php

namespace Database\Factories;

use App\Models\Snippet;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SnippetFactory extends Factory
{
    protected $model = Snippet::class;

    public function definition() : array
    {
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->words(asText: true),
        ];
    }
}
