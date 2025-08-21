<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

/**
 * @property int $id
 * @property string $image_path
 * @property string|null $alt_text
 * @property integer $sort_order
 * @property int $product_id
 * @property string $url
 */
class ProductsImage extends Model {

    use HasFactory, Notifiable;
    protected $fillable = [
        'id',
        'image_path',
        'alt_text',
        'product_id',
        'sort_order',
    ];
    protected $appends = ['url'];
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    public function getUrlAttribute(): string
    {
        /** @var \Illuminate\Filesystem\FilesystemAdapter $disk */
        $disk = Storage::disk('public');
        return $disk->url($this->image_path);
    }

    protected static function boot()
    {

        parent::boot();

        static::deleting(function ($image) {
            /** @var \Illuminate\Filesystem\FilesystemAdapter $disk */
            $disk = Storage::disk('public');
            $disk->delete($image->image_path);
        });
    }
}
