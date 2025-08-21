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
 * @property string $slug
 * @property string $description
 * @property StatuseEnum $status
 * @property integer $sort_order
 * @property integer $parent_id
 */
class Category extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'slug',
        'description',
        'status',
    ];

    protected $casts = [
        'status' => \App\Enum\StatuseEnum::class,
    ];

    public function products(): hasMany
    {
        return $this->hasMany(Product::class);
    }
}
