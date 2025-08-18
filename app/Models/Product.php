<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function productsImages(): hasMany
    {
        return $this->hasMany(ProductsImage::class);
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
