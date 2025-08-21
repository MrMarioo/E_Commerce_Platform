<?php

namespace App\Models;

use App\Enum\StatuseEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

/**
 * @property int $id
 * @property string $name
 * @property string|null $image
 * @property string|null $description
 * @property StatuseEnum $status
 * @property string $slug
 */
class Brand extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'image',
        'description',
        'status',
        'slug'
    ];

    protected $casts = [
        'status' => StatuseEnum::class
    ];

    public function products(): hasMany
    {
        return $this->hasMany(Product::class);
    }
}
