<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class ProductsImage extends Model {

    protected $fillable = [
        'image_path',
        'alt_text',
        'product_id',
    ];
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    public function getUrlAttribute(): string
    {
        return Storage::disk(name: 'public')->url($this->image_path);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($image) {
            Storage::disk(name: 'public')->delete($image->image_path);
        });
    }
}
