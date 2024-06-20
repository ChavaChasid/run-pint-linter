<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'git_repo' => fake()->word(10),
            'description' => fake()->word(20),
            'is_active' => fake()->boolean(1),
        ];
    }
}
