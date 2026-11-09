<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<\App\Models\Project> */
class ProjectFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->unique()->words(3, true),
            'description' => fake()->sentence(12),
            'tech_stack' => 'Laravel, MySQL, Tailwind CSS',
            'demo_url' => null,
            'github_url' => null,
        ];
    }
}
