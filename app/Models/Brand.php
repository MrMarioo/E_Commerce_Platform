<?php

namespace App\Models;

use App\Enum\StatuseEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Brand extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'image',
        'description',
        'status'
    ];

    protected $casts = [
        'status' => StatuseEnum::class
    ];
    
}
