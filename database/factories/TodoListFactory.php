<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TodoList>
 */
class TodoListFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {  
        return [
            'title' => fake()->realText(32),
            'description' => fake()->paragraph(1),
            'note' => fake()->paragraph(1),
        ];
    }
}
