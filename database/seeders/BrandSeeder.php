<?php

namespace Database\Seeders;

use App\Enum\StatuseEnum;
use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            // Electronics brands
            [
                'name' => 'Apple',
                'slug' => 'apple',
                'description' => 'Premium technology and electronics',
                'status' => StatuseEnum::ACTIVE->value,
            ],
            [
                'name' => 'Samsung',
                'slug' => 'samsung',
                'description' => 'Leading electronics manufacturer',
                'status' => StatuseEnum::ACTIVE->value,
            ],
            [
                'name' => 'Sony',
                'slug' => 'sony',
                'description' => 'Electronics and entertainment technology',
                'status' => StatuseEnum::ACTIVE->value,
            ],
            [
                'name' => 'Dell',
                'slug' => 'dell',
                'description' => 'Computer hardware and technology solutions',
                'status' => StatuseEnum::ACTIVE->value,
            ],
            [
                'name' => 'HP',
                'slug' => 'hp',
                'description' => 'Personal computers and printing solutions',
                'status' => StatuseEnum::ACTIVE->value,
            ],
            [
                'name' => 'Lenovo',
                'slug' => 'lenovo',
                'description' => 'Personal computers and mobile devices',
                'status' => StatuseEnum::ACTIVE->value,
            ],

            // Fashion brands
            [
                'name' => 'Nike',
                'slug' => 'nike',
                'description' => 'Athletic footwear and apparel',
                'status' => StatuseEnum::ACTIVE->value,
            ],
            [
                'name' => 'Adidas',
                'slug' => 'adidas',
                'description' => 'Sportswear and athletic equipment',
                'status' => StatuseEnum::ACTIVE->value,
            ],
            [
                'name' => 'Zara',
                'slug' => 'zara',
                'description' => 'Fashion clothing and accessories',
                'status' => StatuseEnum::ACTIVE->value,
            ],
            [
                'name' => 'H&M',
                'slug' => 'hm',
                'description' => 'Fast fashion clothing retailer',
                'status' => StatuseEnum::ACTIVE->value,
            ],
            [
                'name' => 'Uniqlo',
                'slug' => 'uniqlo',
                'description' => 'Casual wear and basics',
                'status' => StatuseEnum::ACTIVE->value,
            ],

            // Home & Garden brands
            [
                'name' => 'IKEA',
                'slug' => 'ikea',
                'description' => 'Furniture and home accessories',
                'status' => StatuseEnum::ACTIVE->value,
            ],
            [
                'name' => 'KitchenAid',
                'slug' => 'kitchenaid',
                'description' => 'Kitchen appliances and tools',
                'status' => StatuseEnum::ACTIVE->value,
            ],
            [
                'name' => 'Bosch',
                'slug' => 'bosch',
                'description' => 'Home appliances and power tools',
                'status' => StatuseEnum::ACTIVE->value,
            ],

            // Sports brands
            [
                'name' => 'Under Armour',
                'slug' => 'under-armour',
                'description' => 'Athletic clothing and accessories',
                'status' => StatuseEnum::ACTIVE->value,
            ],
            [
                'name' => 'Puma',
                'slug' => 'puma',
                'description' => 'Athletic footwear and sportswear',
                'status' => StatuseEnum::ACTIVE->value,
            ],
            [
                'name' => 'The North Face',
                'slug' => 'the-north-face',
                'description' => 'Outdoor clothing and equipment',
                'status' => StatuseEnum::ACTIVE->value,
            ],
            [
                'name' => 'Patagonia',
                'slug' => 'patagonia',
                'description' => 'Outdoor clothing and gear',
                'status' => StatuseEnum::ACTIVE->value,
            ],
        ];

        foreach ($brands as $brandData) {
            Brand::create($brandData);
        }
    }
}
