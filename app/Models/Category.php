<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
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
