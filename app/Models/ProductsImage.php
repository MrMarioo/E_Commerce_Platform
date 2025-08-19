<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductsImage extends Model {

    protected $fillable = [
        'image_path',
        'alt_text',
    ];
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
