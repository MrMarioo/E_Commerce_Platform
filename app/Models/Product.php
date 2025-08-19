<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
