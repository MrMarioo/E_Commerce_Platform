<?php

use App\Models\ProductsImage;

describe('ProductsImageController', function () {
    describe('index', function () {
        test('can list all images', function () {
            $user = \App\Models\User::factory()->create();

            ProductsImage::factory()->count(5)->create();

            $response = $this->actingAs($user)->getJson(route('products-images.index'));

            $response->assertStatus(200);
        });
        test('can filter by product_id', function () {
            $user = \App\Models\User::factory()->create();
            $product = \App\Models\Product::factory()->create();

            $image = ProductsImage::create([
                'product_id' => $product->id,
                'image_path' => 'test.jpg',
                'alt_text' => 'test',
                'sort_order' => 1,
            ]);


            $found = ProductsImage::where('product_id', $product->id)->get();

            expect($found)->toHaveCount(1);
        });
    });
});
