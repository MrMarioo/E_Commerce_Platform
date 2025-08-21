<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductsImage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductsImage>
 */
class ProductsImageFactory extends Factory
{
    protected $model = ProductsImage::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'image_path' => 'products/' . fake()->uuid() . '.jpg',
            'alt_text' => fake()->sentence(),
            'sort_order' => fake()->numberBetween(1, 10),
        ];
    }
}
