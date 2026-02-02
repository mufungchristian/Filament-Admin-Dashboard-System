<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word(),
            'description' => $this->faker->optional()->sentence(),
            'image' => $this->faker->optional()->imageUrl(),
            'is_active' => $this->faker->boolean(90), // 90% active
        ];
    }
}
