<?php

namespace Database\Factories;

use App\Models\Example;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExampleFactory extends Factory
{
    protected $model = Example::class;

    public function definition() : array
    {
        return [
            'title' => $this->faker->words(3, true),
        ];
    }
}
