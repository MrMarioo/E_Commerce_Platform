<?php

namespace Database\Seeders;

use App\Enum\StatuseEnum;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all()->keyBy('slug');
        $brands = Brand::all()->keyBy('slug');

        $products = [
            // Electronics - Smartphones
            [
                'name' => 'iPhone 15 Pro',
                'sku' => 'APL-IP15P-128',
                'description' => 'Latest iPhone with Pro camera system and titanium design',
                'price' => 999.99,
                'stock_quantity' => 50,
                'weight' => 0.187,
                'attributes' => [
                    'color' => 'Natural Titanium',
                    'storage' => '128GB',
                    'screen_size' => '6.1"',
                    'camera' => '48MP Main'
                ],
                'status' => StatuseEnum::ACTIVE->value,
                'category_slug' => 'smartphones',
                'brand_slug' => 'apple',
            ],
            [
                'name' => 'Samsung Galaxy S24 Ultra',
                'sku' => 'SAM-GS24U-256',
                'description' => 'Flagship Android smartphone with S Pen and AI features',
                'price' => 1199.99,
                'stock_quantity' => 35,
                'weight' => 0.232,
                'attributes' => [
                    'color' => 'Titanium Gray',
                    'storage' => '256GB',
                    'screen_size' => '6.8"',
                    'camera' => '200MP Main'
                ],
                'status' => StatuseEnum::ACTIVE->value,
                'category_slug' => 'smartphones',
                'brand_slug' => 'samsung',
            ],

            // Electronics - Laptops
            [
                'name' => 'MacBook Air M3',
                'sku' => 'APL-MBA-M3-13',
                'description' => 'Ultra-thin laptop with M3 chip and all-day battery life',
                'price' => 1099.99,
                'stock_quantity' => 25,
                'weight' => 1.24,
                'attributes' => [
                    'processor' => 'Apple M3',
                    'ram' => '8GB',
                    'storage' => '256GB SSD',
                    'screen_size' => '13.6"'
                ],
                'status' => StatuseEnum::ACTIVE->value,
                'category_slug' => 'laptops',
                'brand_slug' => 'apple',
            ],
            [
                'name' => 'Dell XPS 13',
                'sku' => 'DEL-XPS13-I7',
                'description' => 'Premium ultrabook with InfinityEdge display',
                'price' => 899.99,
                'stock_quantity' => 30,
                'weight' => 1.19,
                'attributes' => [
                    'processor' => 'Intel Core i7',
                    'ram' => '16GB',
                    'storage' => '512GB SSD',
                    'screen_size' => '13.4"'
                ],
                'status' => StatuseEnum::ACTIVE->value,
                'category_slug' => 'laptops',
                'brand_slug' => 'dell',
            ],

            // Clothing - Men's
            [
                'name' => 'Nike Air Force 1',
                'sku' => 'NIK-AF1-WH-10',
                'description' => 'Classic basketball sneakers in white leather',
                'price' => 90.00,
                'stock_quantity' => 100,
                'weight' => 0.6,
                'attributes' => [
                    'color' => 'White',
                    'size' => '10 US',
                    'material' => 'Leather',
                    'type' => 'Basketball Shoes'
                ],
                'status' => StatuseEnum::ACTIVE->value,
                'category_slug' => 'mens-clothing',
                'brand_slug' => 'nike',
            ],
            [
                'name' => 'Adidas Ultraboost 22',
                'sku' => 'ADI-UB22-BK-9',
                'description' => 'Premium running shoes with Boost technology',
                'price' => 180.00,
                'stock_quantity' => 75,
                'weight' => 0.31,
                'attributes' => [
                    'color' => 'Core Black',
                    'size' => '9 US',
                    'material' => 'Primeknit',
                    'type' => 'Running Shoes'
                ],
                'status' => StatuseEnum::ACTIVE->value,
                'category_slug' => 'mens-clothing',
                'brand_slug' => 'adidas',
            ],

            // Home & Garden - Furniture
            [
                'name' => 'IKEA Malm Bed Frame',
                'sku' => 'IKE-MALM-BED-Q',
                'description' => 'Simple and stylish bed frame in white stain oak veneer',
                'price' => 179.00,
                'stock_quantity' => 20,
                'weight' => 35.5,
                'attributes' => [
                    'size' => 'Queen',
                    'color' => 'White stain oak veneer',
                    'material' => 'Particleboard, Fiberboard',
                    'assembly_required' => true
                ],
                'status' => StatuseEnum::ACTIVE->value,
                'category_slug' => 'furniture',
                'brand_slug' => 'ikea',
            ],

            // Home & Garden - Kitchen Appliances
            [
                'name' => 'KitchenAid Stand Mixer',
                'sku' => 'KA-MIXER-RED-5QT',
                'description' => '5-quart tilt-head stand mixer in empire red',
                'price' => 399.99,
                'stock_quantity' => 15,
                'weight' => 11.12,
                'attributes' => [
                    'capacity' => '5 Quart',
                    'color' => 'Empire Red',
                    'attachments_included' => ['Flat Beater', 'Dough Hook', 'Wire Whip'],
                    'tilt_head' => true
                ],
                'status' => StatuseEnum::ACTIVE->value,
                'category_slug' => 'kitchen-appliances',
                'brand_slug' => 'kitchenaid',
            ],

            // Sports - Fitness Equipment
            [
                'name' => 'Under Armour Gym Bag',
                'sku' => 'UA-GYM-BAG-BK',
                'description' => 'Durable gym duffle bag with separate shoe compartment',
                'price' => 45.00,
                'stock_quantity' => 60,
                'weight' => 0.8,
                'attributes' => [
                    'color' => 'Black',
                    'capacity' => '25L',
                    'material' => 'Polyester',
                    'features' => ['Water-resistant', 'Shoe compartment', 'Multiple pockets']
                ],
                'status' => StatuseEnum::ACTIVE->value,
                'category_slug' => 'fitness-equipment',
                'brand_slug' => 'under-armour',
            ],

            // Sports - Outdoor Gear
            [
                'name' => 'The North Face Backpack',
                'sku' => 'TNF-BP-SURGE-31L',
                'description' => '31L laptop backpack for daily commute and light hiking',
                'price' => 99.00,
                'stock_quantity' => 40,
                'weight' => 1.2,
                'attributes' => [
                    'capacity' => '31L',
                    'laptop_compartment' => '15" laptop',
                    'color' => 'TNF Black',
                    'material' => '600D recycled polyester'
                ],
                'status' => StatuseEnum::ACTIVE->value,
                'category_slug' => 'outdoor-gear',
                'brand_slug' => 'the-north-face',
            ],

            // Women's Clothing
            [
                'name' => 'Zara Midi Dress',
                'sku' => 'ZAR-MIDI-BLK-M',
                'description' => 'Elegant black midi dress perfect for office or evening',
                'price' => 79.95,
                'stock_quantity' => 45,
                'weight' => 0.3,
                'attributes' => [
                    'color' => 'Black',
                    'size' => 'Medium',
                    'material' => '95% Polyester, 5% Elastane',
                    'care' => 'Machine wash cold'
                ],
                'status' => StatuseEnum::ACTIVE->value,
                'category_slug' => 'womens-clothing',
                'brand_slug' => 'zara',
            ],

            // Tablets
            [
                'name' => 'iPad Air',
                'sku' => 'APL-IPAD-AIR-64',
                'description' => '10.9-inch iPad Air with M1 chip and vibrant colors',
                'price' => 599.00,
                'stock_quantity' => 30,
                'weight' => 0.461,
                'attributes' => [
                    'screen_size' => '10.9"',
                    'storage' => '64GB',
                    'color' => 'Sky Blue',
                    'chip' => 'Apple M1'
                ],
                'status' => StatuseEnum::ACTIVE->value,
                'category_slug' => 'tablets',
                'brand_slug' => 'apple',
            ],
        ];

        foreach ($products as $productData) {
            $categorySlug = $productData['category_slug'];
            $brandSlug = $productData['brand_slug'];

            unset($productData['category_slug'], $productData['brand_slug']);

            if (isset($categories[$categorySlug]) && isset($brands[$brandSlug])) {
                Product::create([
                    ...$productData,
                    'category_id' => $categories[$categorySlug]->id,
                    'brand_id' => $brands[$brandSlug]->id,
                ]);
            }
        }
    }
}
