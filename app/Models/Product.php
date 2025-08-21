<?php

namespace App\Models;

use App\Enum\StatuseEnum;
use App\Http\Resources\ProductImageResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property float $price
 * @property integer $stock_quantity
 * @property float $weight
 * @property array $attributes
 * @property StatuseEnum $status
 * @property string $sku
 * @property ProductImageResource|null $image
 * @property string $image_path
 * @property string $alt_text
 * @property int $product_id
 * @property string $url
 */
class Product extends Model
{
    protected $fillable = [
        'name',
        'sku',
        'description',
        'price',
        'stock_quantity',
        'weight',
        'attributes',
        'status',
        'image'
    ];
    protected $casts = [
        'attributes' => 'array',
        'status' => \App\Enum\StatuseEnum::class,
        'image' => ProductsImage::class,
        'price' => 'float',
        'stock_quantity' => 'integer',
        'weight' => 'float',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function productsImages(): hasMany
    {
        return $this->hasMany(ProductsImage::class);
    }
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    protected static function booted()
    {
        static::deleting(function ($product) {
            if($product->image){
                $product->image->delete();
            }
        });
        static::deleted(function ($product) {

        });

    }
}
