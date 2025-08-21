<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductImageResource;
use App\Models\Product;
use App\Models\ProductsImage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\QueryBuilder\QueryBuilder;

class ProductsImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $images = QueryBuilder::for(subject: ProductsImage::class)
            ->allowedFilters(filters: ['product_id'])
            ->allowedIncludes(includes: ['product'])
            ->allowedSorts(sorts: ['sort_order', 'created_at'])
            ->defaultSort(sorts: ['sort_order'])
            ->paginate(perPage: $request->input('per_page', 10), page: $request->input('page', 1) + 1);

        return ProductImageResource::collection(resource: $images);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Product $product) : JsonResponse
    {
        $request->validate([
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'alt_text' => 'sometimes|array',
            'alt_text.*' => 'string|nullable'
        ]);

        $uploadedImages = [];

        foreach ($request->file(key: 'images') as $item) {
                $image_name = Str::uuid().'.'.$item->getClientOriginalExtension();
                $image_path = $item->storeAs(path: 'public/products/{$product->id}/{$image_name}', name: $image_name);

                Storage::disk(name: 'public')->put(path:$image_path, contents: file_get_contents($item));

                $maxSortOrder = ProductsImage::where('product_id', $product->id)->max('sort_order');

                $productImage = ProductsImage::create([
                    'product_id' => $product->id,
                    'image_path' => $image_path,
                    'alt_text' => $request->alt_text[$item->getClientOriginalName()] ?? null,
                    'name' => $image_name,
                    'sort_order' => $maxSortOrder + 1,
                ]);

                $uploadedImages[] = $productImage;
        }

        return response()->json(data: [
            'message' => 'Images uploaded successfully',
            'data' => ProductImageResource::collection($uploadedImages),
        ], status: 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
