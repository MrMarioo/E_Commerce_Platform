<?php

namespace Database\Seeders;

use App\Enum\StatuseEnum;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Electronics',
                'slug' => 'electronics',
                'description' => 'Electronic devices and gadgets',
                'status' => StatuseEnum::ACTIVE->value,
                'sort_order' => 1,
                'subcategories' => [
                    [
                        'name' => 'Smartphones',
                        'slug' => 'smartphones',
                        'description' => 'Mobile phones and accessories',
                        'status' => StatuseEnum::ACTIVE->value,
                        'sort_order' => 1,
                    ],
                    [
                        'name' => 'Laptops',
                        'slug' => 'laptops',
                        'description' => 'Portable computers and laptops',
                        'status' => StatuseEnum::ACTIVE->value,
                        'sort_order' => 2,
                    ],
                    [
                        'name' => 'Tablets',
                        'slug' => 'tablets',
                        'description' => 'Tablet computers and accessories',
                        'status' => StatuseEnum::ACTIVE->value,
                        'sort_order' => 3,
                    ],
                ]
            ],
            [
                'name' => 'Clothing',
                'slug' => 'clothing',
                'description' => 'Fashion and clothing items',
                'status' => StatuseEnum::ACTIVE->value,
                'sort_order' => 2,
                'subcategories' => [
                    [
                        'name' => 'Men\'s Clothing',
                        'slug' => 'mens-clothing',
                        'description' => 'Clothing for men',
                        'status' => StatuseEnum::ACTIVE->value,
                        'sort_order' => 1,
                    ],
                    [
                        'name' => 'Women\'s Clothing',
                        'slug' => 'womens-clothing',
                        'description' => 'Clothing for women',
                        'status' => StatuseEnum::ACTIVE->value,
                        'sort_order' => 2,
                    ],
                    [
                        'name' => 'Kids\' Clothing',
                        'slug' => 'kids-clothing',
                        'description' => 'Clothing for children',
                        'status' => StatuseEnum::ACTIVE->value,
                        'sort_order' => 3,
                    ],
                ]
            ],
            [
                'name' => 'Home & Garden',
                'slug' => 'home-garden',
                'description' => 'Home improvement and garden supplies',
                'status' => StatuseEnum::ACTIVE->value,
                'sort_order' => 3,
                'subcategories' => [
                    [
                        'name' => 'Furniture',
                        'slug' => 'furniture',
                        'description' => 'Home and office furniture',
                        'status' => StatuseEnum::ACTIVE->value,
                        'sort_order' => 1,
                    ],
                    [
                        'name' => 'Kitchen Appliances',
                        'slug' => 'kitchen-appliances',
                        'description' => 'Kitchen tools and appliances',
                        'status' => StatuseEnum::ACTIVE->value,
                        'sort_order' => 2,
                    ],
                ]
            ],
            [
                'name' => 'Sports & Outdoors',
                'slug' => 'sports-outdoors',
                'description' => 'Sports equipment and outdoor gear',
                'status' => StatuseEnum::ACTIVE->value,
                'sort_order' => 4,
                'subcategories' => [
                    [
                        'name' => 'Fitness Equipment',
                        'slug' => 'fitness-equipment',
                        'description' => 'Home gym and fitness gear',
                        'status' => StatuseEnum::ACTIVE->value,
                        'sort_order' => 1,
                    ],
                    [
                        'name' => 'Outdoor Gear',
                        'slug' => 'outdoor-gear',
                        'description' => 'Camping and outdoor equipment',
                        'status' => StatuseEnum::ACTIVE->value,
                        'sort_order' => 2,
                    ],
                ]
            ],
        ];

        foreach ($categories as $categoryData) {
            $subcategories = $categoryData['subcategories'] ?? [];
            unset($categoryData['subcategories']);

            $category = Category::create($categoryData);

            // Create subcategories
            foreach ($subcategories as $subcategoryData) {
                $subcategoryData['parent_id'] = $category->id;
                Category::create($subcategoryData);
            }
        }
    }
}
