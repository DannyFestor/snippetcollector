<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    public function definition() : array
    {
        return [
            'title' => $this->faker->unique()->word,
            'color' => $this->faker->hexColor,
            'bgcolor' => $this->faker->hexColor,
            'bordercolor' => $this->faker->hexColor,
        ];
    }
}
