<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->words(3, true);
        
        return [
            'title' => $title,
            'slug' => \App\Helpers\SlugHelper::make($title) . '-' . fake()->unique()->numberBetween(1, 10000),
            'description' => fake()->sentence(),
            'product_type' => fake()->randomElement(['physical', 'digital', 'service']),
            'price' => fake()->numberBetween(10000, 1000000),
            'stock' => fake()->numberBetween(0, 100),
            'is_active' => true,
        ];
    }
}
