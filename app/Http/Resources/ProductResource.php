<?php

namespace App\Http\Resources;

use App\Enum\StatuseEnum;
use App\Models\Brand;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property float $price
 * @property integer|null $stock_quantity
 * @property float|null $weight
 * @property array|null $attributes
 * @property StatuseEnum $status
 * @property int $brand_id
 * @property Brand $brand
 * @property int $category_id
 * @property Category $category
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'stock_quantity' => $this->stock_quantity,
            'weight' => $this->weight,
            'attributes' => $this->attributes,
            'status' => $this->status,
            'brand_id' => $this->brand_id,
            'brand' => new BrandResource($this->whenLoaded(relationship: 'brand')),
            'category_id' => $this->category_id,
            'category' => new CategoryResource($this->whenLoaded(relationship: 'category')),
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
