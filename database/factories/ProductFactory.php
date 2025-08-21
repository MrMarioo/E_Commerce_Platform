<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected  $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->paragraph(),
            'price' => fake()->randomFloat(2, 10, 100),
            'status' => fake()->randomElement(['active', 'inactive']),
            'category_id' => Category::factory(),
            'brand_id' => Brand::factory(),
            'stock_quantity' => fake()->numberBetween(1, 100),
            'weight' => fake()->randomFloat(2, 0.1, 10),
            'sku' => fake()->unique()->numerify('SKU-####'),

        ];
    }
}
