<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->words(2, true);
        
        return [
            'name' => $name,
            'slug' => \App\Helpers\SlugHelper::make($name) . '-' . fake()->unique()->numberBetween(1, 10000),
            'description' => fake()->sentence(),
            'is_active' => true,
        ];
    }
}
